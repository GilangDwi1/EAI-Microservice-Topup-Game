<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class UserViewController extends Controller
{
    public function index()
    {
        $response = Http::post('http://localhost:4001/graphql', [
            'query' => '
                query {
                    listUsers {
                        id
                        name
                        email
                        created_at
                    }
                }
            ',
        ]);

        $users = $response->json('data.listUsers') ?? [];

        return view('index', compact('users'));
    }

    public function show($id)
    {
        // Ambil user
        $userResp = Http::post('http://localhost:4001/graphql', [
            'query' => '
                query ($id: ID!) {
                    getUser(id: $id) {
                        id
                        name
                        email
                        created_at
                    }
                }
            ',
            'variables' => ['id' => $id],
        ]);

        $user = $userResp->json('data.getUser');

        // Ambil transaksi user
        $trxResp = Http::post('http://localhost:4001/graphql', [
            'query' => '
                query ($user_id: ID!) {
                    transactionsByUser(user_id: $user_id) {
                        id
                        jumlah_topup
                        total_harga
                        status
                        created_at
                    }
                }
            ',
            'variables' => ['user_id' => $id],
        ]);

        $transactions = $trxResp->json('data.transactionsByUser') ?? [];

        return view('show', compact('user', 'transactions'));
    }
}
