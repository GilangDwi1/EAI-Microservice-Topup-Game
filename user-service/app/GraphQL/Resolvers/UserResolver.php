<?php

namespace App\GraphQL\Resolvers;

use Illuminate\Support\Facades\Http;
use App\Models\User;

class UserResolver
{
    public function getUser($_, array $args)
    {
        return \App\Models\User::find($args['id']);
    }

    public function transactions($root, array $args)
    {
        // Ambil transaksi dari transaction-service berdasarkan user_id
        $userId = $root->id;

        $response = Http::get("http://localhost:4002/api/transactions", [
            'user_id' => $userId
        ]);

        if ($response->successful()) {
            return $response->json(); // pastikan API return list transaksi
        }

        return [];
    }
}
