<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCreateOrderRequest;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOrderController extends Controller
{
    use ApiResponse;

    public function getAllOrders()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        $orderResource = OrderResource::collection($orders);
        return ApiResponse::successResponseWithData($orderResource, "All Orders retrieved", Response::HTTP_OK);
    }

    public function createOrder(User $user, AdminCreateOrderRequest $request)
    {
        $data = $request->validated();
        foreach ($data['product'] as $item) {
            $product = Product::where('id', $item['product_id'])->first();
            $data['product_id'] = $item['product_id'];
            $data['seller_id'] = $product['merchant_id'];
            $data['buyer_id'] = $user->id;
            $data['price'] = $product['price'];
            $data['quantity'] = $item['quantity'];
            $data['delivery_charge'] = $item['delivery_charge'];
            $data['exp_delivery_date'] = Carbon::now()->addDays(5);
            $data['payment_status'] = "sucessfull";

            $order = Order::create($data);
            $product->update(['number_of_orders' => $product['number_of_orders'] + $item['quantity'], 'quantity' => $product['quantity'] - $item['quantity']]);
            $merchant = Merchant::find($product['merchant_id']);
            $sellerWallet = Wallet::where('user_id', $merchant['user_id'])->first();
            $sellerWallet->update([
                'escrow_amount' => $sellerWallet['escrow_amount'] + $product['price']
            ]);
            saveAdminActivityLog("order_created", "Order", $order->id);
        }
        return ApiResponse::successResponse('New Order was created Successfully', Response::HTTP_CREATED);
    }

    public function getSingleOrder(Order $order)
    {
        $orderResource = new OrderResource($order);
        return ApiResponse::successResponseWithData($orderResource, "Order Details retrieved successfully", Response::HTTP_OK);
    }

    public function getOrdersByUser(User $user)
    {
        $orders = Order::where('buyer_id', $user->id)->orderBy('created_at', 'DESC')->get();
        $orderResource = OrderResource::collection($orders);
        return ApiResponse::successResponseWithData($orderResource, "Orders by a User retrieved", Response::HTTP_OK);
    }

    public function getOrdersForMerchant(Merchant $merchant)
    {
        $orders = Order::where('seller_id', $merchant->id)->orderBy('created_at', 'DESC')->get();
        $orderResource = OrderResource::collection($orders);
        return ApiResponse::successResponseWithData($orderResource, "Orders for a Merchant retrieved", Response::HTTP_OK);
    }

    public function acceptOrder(Order $order)
    {
        $order->update(['status' => "Accepted"]);
        $orderResource = new OrderResource($order);
        saveAdminActivityLog("order_accpeted", "Order", $order->id);
        return ApiResponse::successResponseWithData($orderResource, "Order has been accepted", Response::HTTP_OK);
    }

    public function rejectOrder(Order $order)
    {
        $order->update(['status' => "Rejected"]);
        $orderResource = new OrderResource($order);
        saveAdminActivityLog("order_rejected", "Order", $order->id);
        return ApiResponse::successResponseWithData($orderResource, "Order has been rejected", Response::HTTP_OK);
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
        saveAdminActivityLog("order_deleted", "Order", $order->id);
        return ApiResponse::successResponse("Order was deleted successfully", Response::HTTP_OK);
    }
}
