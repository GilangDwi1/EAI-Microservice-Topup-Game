<?php

namespace App\GraphQL\Resolvers;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class TransactionResolver
{
    // Resolver untuk field game di tipe Transaction
    public function game($transaction)
    {
        $response = Http::get('http://localhost:4000/api/games/' . $transaction->game_id);
        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }

    public function resolveUser($root, array $args)
    {
        // Ambil user_id dari transaksi
        $userId = $root->user_id;

        // Panggil user-service (sesuaikan URL dan endpoint)
        $response = Http::get("http://localhost:4001/api/users/$userId");

        if ($response->failed()) {
            return null; // atau throw error jika ingin ketat
        }

        return $response->json();
    }
    
    public function byUser($_, array $args)
    {
        return Transaction::where('user_id', $args['user_id'])->get();
    }
}
