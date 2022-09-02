<?php

use Illuminate\Support\Facades\Route;
use Faker\Factory;

Route::get('/', function () {
    $faker = Factory::create();
    echo  $faker->email;
});
