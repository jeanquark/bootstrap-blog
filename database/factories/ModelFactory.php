<?php

use Carbon\Carbon;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $count_posts = App\Post::count();
    return [
        'post_id' => $faker->numberBetween($min = 1, $max = $count_posts),
        'name' => $faker->name,
        'message' => $faker->text($maxNbChars = 200),
        'is_published' => 1,
        'published_at' => $faker->dateTimeThisMonth($max = 'now'),
    ];
});

$factory->define(App\CommentReply::class, function (Faker\Generator $faker) {
    $count_comments = App\Comment::count();
    return [
        'comment_id' => $faker->numberBetween($min = 1, $max = $count_comments),
        'name' => $faker->name,
        'message' => $faker->text($maxNbChars = 200),
        'is_published' => 1,
        'published_at' => $faker->dateTimeThisMonth($max = 'now'),
    ];
});

$factory->define(App\Contact::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->safeEmail,
        'name' => $faker->name,
        'message' => $faker->text($maxNbChars = 200),
        'is_read' => 1,
    ];
});