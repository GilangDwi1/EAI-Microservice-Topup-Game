<?php

namespace App\GraphQL\Queries;

use App\Models\Payment;

class PaymentQuery
{
    public function getPayment($_, array $args)
    {
        return Payment::where('id', $args['id'])->first(); // atau ->find($args['id']);
    }
}
