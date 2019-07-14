<?php

/* @var $factory Factory */

use App\Transaction;
use App\Seller;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Transaction::class, function (Faker $faker) {
    $seller = Seller::has('products')->get()->random();
    $buyer = User::all()->except($seller->id)->random();
    return [
        'quantity' => $faker->numberBetween(1,100),
        'buyer_id' => $buyer->id,
        'product_id' => $seller->products->random()->id,
    ];
});
