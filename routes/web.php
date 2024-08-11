<?php

use App\Http\Controllers\JokeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/joke', [JokeController::class, 'displayIndexPage']);
route::post('/joke', [JokeController::class, 'getJoke']);
