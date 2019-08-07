<?php

namespace App\Providers;

use App\Mail\UserCreatedMail;
use App\Mail\UserMailChangeEmail;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        Schema::defaultStringLength(191);

        User::created(function (User $user) {
            retry(5, function () use ($user) {
                Mail::to($user)->send(new UserCreatedMail($user));
            },
                100
            );
        });

        User::updated(function (User $user) {
            if ($user->isDirty('email'))
                retry(5, function () use ($user) {
                    Mail::to($user)->send(new UserMailChangeEmail($user));
                },
                    100
                );
        });

        Product::updated(function (Product $product) {
            if ($product->quantity === 0 && $product->isAvailable()) {
                $product->status = Product::PRODUCT_NOT_AVAILABLE;
                $product->save();
            }
        });
    }
}
