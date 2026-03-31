<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Traits\PaymentTraits;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    use PaymentTraits;

    public function placeOrder(CreateOrderRequest $request)
    {
        $data = $request->validated();

        if ($data['payment_method'] == "wallet") {
            $this->pay_with_wallet($data, "Payment for Order");
            self::createOrderFunction($data);
        }

        if ($data['payment_method'] == "paystack") {
            $this->pay_with_paystack($data, "Payment for Order");
            self::createOrderFunction($data);
        }

        if ($data['payment_method'] == "flw") {
            $this->pay_with_flw($data, "Payment for Order");
            self::createOrderFunction($data);
        }

        if ($data['payment_method'] == "card") {
            $this->pay_with_card($data, "Payment for Order");
            self::createOrderFunction($data);
        }

        if ($data['payment_method'] == "cash") {
            self::createOrderFunction($data);
        }

        return ApiResponse::successResponse('New Order was created Successfully', Response::HTTP_CREATED);
    }

    public function getSingleOrder(Order $order)
    {
        $orderResource = new OrderResource($order);
        return ApiResponse::successResponseWithData($orderResource, "Order Details retrieved", Response::HTTP_OK);
    }

    public function ordersByMe()
    {
        $orders = Order::where('buyer_id', auth()->user()->id)->orderBy('created_at', "DESC")->get();
        $orderResource =  OrderResource::collection($orders);
        return ApiResponse::successResponseWithData($orderResource, "Order placed by Me", Response::HTTP_OK);
    }

    public function ordersForMerchants()
    {
        $orders = Order::where('seller_id', auth()->user()->id)->orderBy('created_at', "DESC")->get();
        $orderResource =  OrderResource::collection($orders);
        return ApiResponse::successResponseWithData($orderResource, "Order for me as a Merchant retrieved ", Response::HTTP_OK);
    }

    public function acceptOrder(Order $order)
    {
        if ($order->seller_id != auth()->user()->id) {
            return ApiResponse::errorResponse("You do not have permission to act on this order", Response::HTTP_FORBIDDEN);
        }
        if ($order->status == "Rejected") {
            return ApiResponse::errorResponse("Order has already been rejected, hence Accepting failed", Response::HTTP_BAD_REQUEST);
        }
        $order->update(['status' => "Accepted"]);

        newNotification(auth()->user()->id, $order->buyer_id, $order->id, 'Order', config('constants.order.accept.title'), config('constants.order.accept.message'));

        $orderResource = new OrderResource($order);
        return ApiResponse::successResponseWithData($orderResource, "Order has been accepted", Response::HTTP_OK);
    }

    public function rejectOrder(Order $order)
    {
        if ($order->seller_id != auth()->user()->id) {
            return ApiResponse::errorResponse("You do not have permission to act on this order", Response::HTTP_FORBIDDEN);
        }
        if ($order->status == "Accepted") {
            return ApiResponse::errorResponse("Order has already been accepted, hence Rejection failed", Response::HTTP_BAD_REQUEST);
        }
        $order->update(['status' => "Rejected"]);

        newNotification(auth()->user()->id, $order->buyer_id, $order->id, 'Order', config('constants.order.reject.title'), config('constants.order.reject.message'));

        $orderResource = new OrderResource($order);
        return ApiResponse::successResponseWithData($orderResource, "Order has been rejected", Response::HTTP_OK);
    }


    protected function createOrderFunction($data)
    {
        foreach ($data['cart'] as $item) {
            $cart = Cart::find($item['cart_id']);
            $product = Product::find($cart->product_id);
            $data['product_id'] = $product['id'];
            $data['buyer_id'] = auth()->user()->id;
            $data['seller_id'] = $product['user_id'];
            $price = $product['discount_amount'] * $cart['number_of_items'];
            $data['price'] = $price;
            $data['quantity'] = $cart['number_of_items'];
            $data['delivery_charge'] = $item['delivery_charge'];
            $data['exp_delivery_date'] = Carbon::now()->addDays(5);
            $data['payment_status'] = "sucessfull";

            $order = Order::create($data);
            $product->update(['number_of_orders' => $product['number_of_orders'] + $cart['number_of_items'], 'quantity' => $product['quantity'] - $cart['number_of_items']]);
            $merchant = Merchant::find($product['merchant_id']);
            $sellerWallet = Wallet::where('user_id', $merchant['user_id'])->first();
            $sellerWallet->update([
                'escrow_amount' => $sellerWallet['escrow_amount'] + $price
            ]);

            //remove items from cart after checkout
            $cart->delete();
            newNotification($data['buyer_id'], $data['seller_id'], $order->id, 'Order', config('constants.order.initiate.title'), config('constants.order.initiate.message'));
        }
    }
}
