<?php

namespace App\Http\Controllers\Flip;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    use ApiResponse;

    public function getCart()
    {
        $carts = Cart::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->get();
        $cartResource = CartResource::collection($carts);
        return ApiResponse::successResponseWithData($cartResource, "User's cart retrieved successfully", Response::HTTP_OK);
    }

    public function createCart(CreateCartRequest $request, Product $product)
    {
        $data = $request->validated();
        $userID = auth()->user()->id;
        $data['user_id'] = $userID;
        $data['product_id'] = $product->id;

        if ($product->user_id == $userID) {
            return ApiResponse::errorResponse("Cannot add product that belongs to you", Response::HTTP_CONFLICT);
        }

        if ($data['number_of_items'] > $product['quantity']) {
            return ApiResponse::errorResponse("Number of Items selcted exceeds the product quantity in stock", Response::HTTP_BAD_REQUEST);
        }

        $cart = Cart::create($data);
        $cartResource = new CartResource($cart);
        return ApiResponse::successResponseWithData($cartResource, "Product add to cart successfully", Response::HTTP_CREATED);
    }

    public function updateCart(Cart $cart, UpdateCartRequest $request, string $action)
    {
        $data = $request->validated();
        if ($action == "add") {
            $product = Product::find($cart->product->id);
            if ($data['number_of_items'] > $product['quantity']) {
                return ApiResponse::errorResponse("Number of Items selcted exceeds the product quantity in stock", Response::HTTP_BAD_REQUEST);
            }
            $cart->update([
                'number_of_items' => $cart['number_of_items'] + $data['number_of_items']
            ]);
        } elseif ($action == "remove") {
            if ($data['number_of_items'] < 1) {
                return ApiResponse::errorResponse("Selected number of items cannot be less than 1(one)", Response::HTTP_BAD_REQUEST);
            }
            $cart->update([
                'number_of_items' => $cart['number_of_items'] - $data['number_of_items']
            ]);
        }
        $cartResource = new CartResource($cart);
        return ApiResponse::successResponseWithData($cartResource, "Cart was updated successfully", Response::HTTP_OK);
    }

    public function removeCart(Cart $cart)
    {
        $cart->delete();
        return ApiResponse::successResponse("Cart Item removed Successfully", Response::HTTP_OK);
    }
}
