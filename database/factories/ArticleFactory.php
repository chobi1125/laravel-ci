<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
//==========ここから追加==========
use App\User;
//==========ここまで追加==========
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        //==========ここから追加==========
        'title' => $faker->text(50),
        'body' => $faker->text(500),
        'user_id' => function() {
            return factory(User::class);
        }
        //==========ここまで追加==========
    ];
});