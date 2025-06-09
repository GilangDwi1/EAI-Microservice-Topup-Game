<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index()
    {
        $query = <<<GRAPHQL
        query {
            listUsers {
                id
                name
                email
                created_at
            }
        }
        GRAPHQL;

        try {
            $response = Http::post('http://localhost:8001/graphql', [
                'query' => $query
            ]);

            $users = collect($response->json()['data']['listUsers'] ?? []);
        } catch (\Exception $e) {
            $users = collect([]);
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $mutation = <<<GRAPHQL
        mutation {
            createUser(
                name: "{$request->name}"
                email: "{$request->email}"
                password: "{$request->password}"
            ) {
                id
                name
                email
            }
        }
        GRAPHQL;

        try {
            $response = Http::post('http://localhost:8001/graphql', [
                'query' => $mutation
            ]);

            if (isset($response->json()['data']['createUser'])) {
                return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
            } else {
                $errorMessage = $response->json()['errors'][0]['message'] ?? 'Gagal menambahkan user.';
                return back()->with('error', $errorMessage)->withInput();
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $queryUser = <<<GRAPHQL
        query {
            getUser(id: "{$id}") {
                id
                name
                email
                created_at
                transactions {
                    id
                    jumlah_topup
                    total_harga
                    status
                    created_at
                }
            }
        }
        GRAPHQL;

        try {
            $response = Http::post('http://localhost:8001/graphql', [
                'query' => $queryUser
            ]);

            $user = $response->json()['data']['getUser'] ?? null;

            if (!$user) {
                abort(404);
            }
        } catch (\Exception $e) {
            abort(404);
        }

        return view('users.show', compact('user'));
    }
}
