<?php

namespace App\GraphQL\Resolvers;

use Illuminate\Support\Facades\Http;

class UserResolver
{
    public function getUser($_, array $args)
    {
        return \App\Models\User::find($args['id']);
    }

    public function transactions($user)
    {
        $userId = $user->id;

        $response = Http::post('http://localhost:4002/graphql', [
            'query' => '
                query($user_id: ID!) {
                    listTransactionsByUser(user_id: $user_id) {
                        id
                        jumlah_topup
                        total_harga
                        status
                        created_at
                    }
                }
            ',
            'variables' => [
                'user_id' => $userId
            ]
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json('data.listTransactionsByUser');
    }
}
