<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCartController extends Controller
{
    use ApiResponse;

    public function getAllCarts()
    {
        $carts = Cart::orderBy('created_at', 'DESC')->get();
        $cartResource = CartResource::collection($carts);
        return ApiResponse::successResponseWithData($cartResource, "All Carts retrieved", Response::HTTP_OK);
    }
}
