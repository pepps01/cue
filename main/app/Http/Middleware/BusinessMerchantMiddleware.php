<?php

namespace App\Http\Middleware;

use App\Models\Merchant;
use Closure;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class BusinessMerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user() && auth()->user()->role == "merchant") {
            $merchant = Merchant::where('user_id', auth()->user()->id)->first();
            if ($merchant['merchant_type'] == "business") {
                return $next($request);
            }
        }
        return ApiResponse::errorResponse("Only merchants registered as a business can proceed", Response::HTTP_FORBIDDEN);
    }
}
