<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\User;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    $faker->seed($faker->randomDigit);
    $labels = [];
    for ($i = 0; $i <= $faker->randomDigit; $i++) {
        $labels[$faker->unique()->uuid] = $faker->word;
    }
    ksort($labels);

    return [
        'user_id' => $faker->numberBetween(1, 50),
        'data' => [
            'title' => $faker->word,
            'label_ids' => array_keys($labels),
            'labels' => $labels
        ]
    ];
});
