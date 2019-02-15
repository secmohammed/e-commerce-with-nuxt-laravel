<?php

namespace App\App\Http\Middleware\Cart;

use App\App\Domain\Cart\Cart;
use Closure;

class RespondIfEmpty
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->cart->isEmpty()) {
            return response()->json([
                'message' =>'Cart is empty'
            ], 400);
        }
        return $next($request);
    }
}
