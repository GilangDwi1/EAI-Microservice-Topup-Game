<?php
namespace App\GraphQL\Mutations;

use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class CreateTransaction
{
    public function __invoke($_, array $args)
    {
        // Panggil API game-service untuk ambil data game
        $response = Http::get('http://localhost:4000/api/games/'.$args['game_id']);

        if ($response->failed()) {
            throw new \Exception('Game tidak ditemukan di game-service');
        }

        $game = $response->json();

        $jumlah = $args['jumlah_topup'] ?? $args['jumlah'] ?? 1; // Pastikan pakai arg yg sesuai
        $total_harga = $game['harga'] * $jumlah;

        // Simpan transaksi di transaction-service
        $transaction = Transaction::create([
            'user_id' => $args['user_id'],
            'game_id' => $args['game_id'],
            'jumlah_topup' => $jumlah,
            'total_harga' => $total_harga,
            'status' => 'pending',
        ]);

        $mutation = '
            mutation {
                reduceStock(id: '.$args['game_id'].', amount: '.$jumlah.') {
                    id
                    stock
                }
            }
        ';

        $stockResponse = Http::post('http://localhost:4000/graphql', [
            'query' => $mutation,
        ]);

        if ($stockResponse->failed()) {
            // Bisa rollback transaksi atau beri notifikasi error
            throw new \Exception('Gagal mengurangi stock di game-service');
        }

        return $transaction;
    }
}
