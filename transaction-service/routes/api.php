<?php

use Illuminate\Support\Facades\Route;
use App\Models\Transaction;

Route::get('/transactions/user/{id}', function ($id) {
    return Transaction::where('user_id', $id)->get();
});
