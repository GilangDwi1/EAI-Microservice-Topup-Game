<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GameController extends Controller
{
    public function index()
    {
        // Query untuk mendapatkan semua game menggunakan GraphQL
        $query = <<<GRAPHQL
        query {
            listGames {
                id
                nama_game
                publisher
                description
                stock
                harga
                created_at
                updated_at
            }
        }
        GRAPHQL;

        try {
            $response = Http::post('http://localhost:4000/graphql', [
                'query' => $query
            ]);

            $games = collect($response->json()['data']['listGames'] ?? []);
        } catch (\Exception $e) {
            $games = collect([]);
        }

        return view('games.index', compact('games'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_game' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'harga' => 'nullable|integer|min:0'
        ]);

        $harga = $request->harga ? (int) $request->harga : 'null';

        $mutation = <<<GRAPHQL
        mutation {
            createGame(
                nama_game: "{$request->nama_game}"
                publisher: "{$request->publisher}"
                description: "{$request->description}"
                stock: {$request->stock}
                harga: {$harga}
            ) {
                id
                nama_game
                publisher
                description
                stock
                harga
            }
        }
        GRAPHQL;

        try {
            $response = Http::post('http://localhost:4000/graphql', [
                'query' => $mutation
            ]);

            if (isset($response->json()['data']['createGame'])) {
                return redirect()->route('games.index')->with('success', 'Game berhasil ditambahkan!');
            } else {
                $errorMessage = $response->json()['errors'][0]['message'] ?? 'Gagal menambahkan game.';
                return back()->withInput()->with('error', $errorMessage);
            }
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $query = <<<GRAPHQL
        query {
            listGames {
                id
                nama_game
                publisher
                description
                stock
                harga
                created_at
                updated_at
            }
        }
        GRAPHQL;

        try {
            $response = Http::post('http://localhost:4000/graphql', [
                'query' => $query
            ]);

            $games = $response->json()['data']['listGames'] ?? [];
            $game = collect($games)->firstWhere('id', $id);

            if (!$game) {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }

        return view('games.show', compact('game'));
    }

    public function topupForm($id)
    {
        $query = <<<GRAPHQL
        query {
            listGames {
                id
                nama_game
                publisher
                description
                stock
                harga
                created_at
                updated_at
            }
        }
        GRAPHQL;

        try {
            $response = Http::post('http://localhost:4000/graphql', [
                'query' => $query
            ]);

            $games = $response->json()['data']['listGames'] ?? [];
            $game = collect($games)->firstWhere('id', $id);

            if (!$game) {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }

        return view('games.topup', compact('game'));
    }

    public function topup(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|integer|min:1'
        ]);

        $mutation = '
        mutation {
            topUpGame(id: "' . $id . '", amount: ' . $request->amount . ') {
                id
                nama_game
                stock
                harga
            }
        }';

        try {
            $response = Http::post('http://localhost:4000/graphql', [
                'query' => $mutation
            ]);

            if (isset($response->json()['data']['topUpGame'])) {
                return redirect()->route('games.show', $id)->with('success', 'Top-up berhasil! Stock game telah ditambahkan.');
            } else {
                return back()->with('error', 'Gagal melakukan top-up.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
