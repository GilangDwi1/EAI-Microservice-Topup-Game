<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransactionController;

Route::get('/transactions', [TransactionController::class, 'getByUser']);
