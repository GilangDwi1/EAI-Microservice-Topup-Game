<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function getByUser(Request $request)
    {
        $userId = $request->query('user_id');

        if (!$userId) {
            return response()->json(['error' => 'user_id is required'], 400);
        }

        $transactions = Transaction::where('user_id', $userId)->get();

        return response()->json($transactions);
    }
}
