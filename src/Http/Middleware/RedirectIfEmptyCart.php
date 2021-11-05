<?php

namespace Guysolamour\Administrable\Extensions\Shop\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Guysolamour\Administrable\Extensions\Shop\Facades\Cart;

class RedirectIfEmptyCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Cart::isEmpty()){
            flashy()->error('Votre panier est vide.');

            if (Route::has(front_route_path('shop.index'))){
                return redirect()->route(config('administrable-shop.redirect_empty_cart', '/'));
            }

            return redirect()->home();
        }

        return $next($request);
    }
}
