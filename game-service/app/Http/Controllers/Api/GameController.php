<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function show($id)
    {
        $game = Game::find($id);
        if (!$game) {
            return response()->json(['error' => 'Game not found'], 404);
        }
        return response()->json($game);
    }
}
