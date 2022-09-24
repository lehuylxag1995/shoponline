<?php

namespace App\Providers;

use App\View\Composers\CartComposer;
use App\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Using class based composers...
        View::composer(
            [
                'guest.home.app',
                'guest.product.show',
                'guest.menu.product',
                'guest.cart.list'
            ],
            MenuComposer::class
        );

        View::composer([
            'guest.home.app',
            'guest.product.show',
            'guest.menu.product',
            'guest.cart.list'
        ], CartComposer::class);

        // Using closure based composers...
        // View::composer('dashboard', function ($view) {
        //     //
        // });
    }
}
