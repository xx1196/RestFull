<?php

/* @var $factory Factory */

use App\Product;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'quantity' => $faker->numberBetween(1, 10),
        'status' => $faker->randomElement([
            Product::PRODUCT_AVAILABLE,
            Product::PRODUCT_NOT_AVAILABLE,
        ]),
        'image' => $faker->randomElement([
            '1.jpg',
            '2.jpg',
            '3.jpg',
        ]),
        'seller_id' => User::all()->random()->id,
    ];
});
