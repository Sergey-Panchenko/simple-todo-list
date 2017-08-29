<?php

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
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(\App\Models\Project::class, function (Faker\Generator $faker) {
  static $project_position = 0;
  $project_position++;
  return [
    'name' => $faker->sentence(4),
    'position' => $project_position,
  ];
});

$factory->define(\App\Models\Task::class, function (Faker\Generator $faker) {
  static $task_position = 0;
  $task_position++;
  return [
    'name' => $faker->sentence(4),
    'position' => $task_position,
    'project_id' => \App\Models\Project::all()->random(1)->first()->id,
  ];
});


