<?php
namespace App\GraphQL\Mutations;

use App\Models\Transaction;

class TransactionMutation
{
    public function updateStatus($_, array $args)
    {
        $trx = Transaction::findOrFail($args['id']);
        $trx->status = $args['status'];
        $trx->save();

        return $trx;
    }
}
