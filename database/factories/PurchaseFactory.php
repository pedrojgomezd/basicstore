<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    return [
        'customer_id' => factory(Customer::class)->create()->id,
        'request_id' => $faker->uuid,
        'process_url' => env('APP_URL'),
        'status' => 'CREATED',
        'description' => $faker->text(20),
        'amount' => random_int(100, 250000)
    ];
});
