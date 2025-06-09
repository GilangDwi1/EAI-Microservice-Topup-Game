<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Transaction;

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

        // Ambil transaksi dari database lokal
        $transactions = Transaction::where('user_id', $id)->get();

        return view('show', compact('user', 'transactions'));
    }
}
