<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\Api\GameController;

Route::get('/games/{id}', [GameController::class, 'show']);
