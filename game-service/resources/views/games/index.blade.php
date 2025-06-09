@extends('layouts.app')

@section('title', 'Daftar Game')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <i class="fas fa-gamepad mr-3 text-purple-600"></i>
                Daftar Game
            </h1>
            <p class="mt-2 text-gray-600">Kelola semua game yang tersedia dalam sistem</p>
        </div>
        <a href="{{ route('games.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out shadow-lg hover:shadow-xl">
            <i class="fas fa-plus mr-2"></i>
            Tambah Game Baru
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-gamepad text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Game</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($games) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-boxes text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Stock</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $games->sum('stock') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-building text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Publisher</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $games->unique('publisher')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Games Grid -->
    @if(count($games) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($games as $game)
                <div class="bg-white rounded-lg shadow-md overflow-hidden card-hover">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 truncate">{{ $game['nama_game'] }}</h3>
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                ID: {{ $game['id'] }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-building mr-2 text-purple-500"></i>
                                <span class="text-sm">{{ $game['publisher'] }}</span>
                            </div>

                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-boxes mr-2 text-blue-500"></i>
                                <span class="text-sm">
                                    Stock:
                                    <span class="font-semibold {{ $game['stock'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $game['stock'] }}
                                    </span>
                                </span>
                            </div>

                            @if($game['harga'])
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-tag mr-2 text-green-500"></i>
                                    <span class="text-sm font-semibold text-green-600">
                                        Rp {{ number_format($game['harga'], 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif

                            <div class="text-gray-600 text-sm">
                                <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                                {{ Str::limit($game['description'], 100) }}
                            </div>
                        </div>

                        <div class="mt-6 flex space-x-2">
                            <a href="{{ route('games.show', $game['id']) }}"
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 px-4 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                            <a href="{{ route('games.topup', $game['id']) }}"
                               class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-2 px-4 rounded-md text-sm font-medium transition duration-150 ease-in-out">
                                <i class="fas fa-plus mr-1"></i>
                                Top-up
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <div class="mx-auto h-24 w-24 text-gray-400">
                <i class="fas fa-gamepad text-6xl"></i>
            </div>
            <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada game</h3>
            <p class="mt-2 text-gray-500">Mulai dengan menambahkan game pertama Anda.</p>
            <div class="mt-6">
                <a href="{{ route('games.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Game Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
