<?php
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/users/{id}', function ($id) {
    $user = User::find($id);
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }
    return response()->json($user);
});
