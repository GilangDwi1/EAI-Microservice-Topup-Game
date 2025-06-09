<?php

namespace App\GraphQL\Mutations;

use App\Models\Payment;
use Illuminate\Support\Facades\Http;

class PaymentMutation
{
    public function create($_, array $args)
    {
        $payment = Payment::create($args);

        // PaymentMutation.php
        $trxResponse = Http::post('http://localhost:4002/graphql', [
            'query' => '
                mutation($id: ID!, $status: String!) {
                    updateTransactionStatus(id: $id, status: $status) {
                        id
                        status
                    }
                }
            ',
            'variables' => [
                'id' => $args['id_transaction'],
                'status' => 'selesai',
            ],
        ]);
        if ($trxResponse->failed()) {
            // Bisa rollback payment kalau perlu
        }

        return $payment;
    }
}
