<?php

use App\Http\Controllers\JokeController;
use Illuminate\Support\Facades\Route;



route::get('/', [JokeController::class, 'displayIndexPage']);
route::post('/joke', [JokeController::class, 'getJoke']);
