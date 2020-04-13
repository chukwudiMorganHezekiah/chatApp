<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    do {
        $from=rand(1,15);
        $to=rand(1,15);

    }while($from===$to);
    return [
        //

        'from' => $from,
        'to' => $to,
        'message' => $faker->sentence,
    ];
});
