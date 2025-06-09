<?php
use App\Http\Controllers\UserViewController;

Route::get('/users', [UserViewController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserViewController::class, 'show'])->name('users.show');
