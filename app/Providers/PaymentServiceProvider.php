<?php

namespace App\Providers;

use App\Paymentservice\PaypalApi;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(PaypalApi::class,function(){
            return new PaypalApi('testtoken'.rand(0,1500));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
