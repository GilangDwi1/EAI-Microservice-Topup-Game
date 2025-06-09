<?php

namespace App\GraphQL\Resolvers;

use Illuminate\Support\Facades\Http;

class UserResolver
{
    public function transactions($root, array $args)
    {
        $userId = $root['id'];

        $response = Http::post('http://localhost:5000/graphql', [
            'query' => '
                query {
                    listTransactionsByUser(user_id: '.$userId.') {
                        id
                        jumlah_topup
                        total_harga
                        status
                        created_at
                    }
                }
            ',
        ]);

        return $response->json()['data']['listTransactionsByUser'] ?? [];
    }
}
