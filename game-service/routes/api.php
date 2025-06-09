<?php
use App\Http\Controllers\Api\GameController;

Route::get('/games/{id}', [GameController::class, 'show']);
