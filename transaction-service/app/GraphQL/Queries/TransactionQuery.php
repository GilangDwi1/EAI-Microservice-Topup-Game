<?php
namespace App\GraphQL\Queries;
use Illuminate\Support\Facades\Http;

use App\Models\Transaction;

class TransactionQuery
{
    public function listTransactions()
    {
        return Transaction::all();
    }

    public function getTransaction($_, array $args)
    {
        $transaction = Transaction::findOrFail($args['id']);

        // Ambil data user dari user-service
        $userResponse = Http::get('http://localhost:4001/api/users/' . $transaction->user_id);
        $user = $userResponse->successful() ? $userResponse->json() : null;

        // Ambil data game dari game-service
        $gameResponse = Http::get('http://localhost:4000/api/games/' . $transaction->game_id);
        $game = $gameResponse->successful() ? $gameResponse->json() : null;

        // Gabungkan data
        return [
            'id' => $transaction->id,
            'jumlah_topup' => $transaction->jumlah_topup,
            'status' => $transaction->status,
            'user' => $user,
            'game' => $game,
        ];
    }
}
