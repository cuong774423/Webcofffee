<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades;
use Illuminate\View\View;
use App\Models\Category;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {   
        Facades\View::composer(['layouts.header'], function ($view) {
            $producttypes=Category::all();
            //truyền biến $producttypes cho view header thông qua biến $view
            $view->with('cates',$producttypes);
        });
        Facades\View::composer(['layouts.header','pages.checkout','pages.cart'], function (View $view) {
            if(Session('cart')){
                $oldCart=Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'productCarts'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
    }
}
