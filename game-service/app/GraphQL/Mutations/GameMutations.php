<?php
namespace App\GraphQL\Mutations;

use App\Models\Game;

class GameMutation
{
    public function topUpGame($_, array $args)
    {
        $game = Game::findOrFail($args['id']);
        if ($game->stock < $args['amount']) {
            throw new \Exception('Stock tidak mencukupi');
        }

        $game->stock - $args['amount'];
        $game->save();

        return $game;
    }

    public function reduceStock($_, array $args)
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
