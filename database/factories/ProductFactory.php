<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word($nb = 5),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 200) // 48.8932
    ];
});
