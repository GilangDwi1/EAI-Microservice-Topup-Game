<?php
namespace App\GraphQL\Mutations;

use App\Models\Game;

class ReduceStock
{
    public function __invoke($_, array $args)
    {
        $game = Game::findOrFail($args['id']);

        if ($game->stock < $args['amount']) {
            throw new \Exception('Stock tidak cukup');
        }

        $game->stock -= $args['amount'];
        $game->save();

        return $game;
    }
}
