@extends('layouts.app')

@section('title', $game['nama_game'])

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('games.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-purple-600">
                                <i class="fas fa-home mr-2"></i>
                                Game
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-sm font-medium text-gray-500">{{ $game['nama_game'] }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-bold text-gray-900 mt-2">
                    <i class="fas fa-gamepad mr-3 text-purple-600"></i>
                    {{ $game['nama_game'] }}
                </h1>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('games.topup', $game['id']) }}"
                   class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    <i class="fas fa-plus mr-2"></i>
                    Top-up Stock
                </a>
                <a href="{{ route('games.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
        </div>

        <!-- Game Details -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info Card -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Informasi Game</h2>
                        <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            ID: {{ $game['id'] }}
                        </span>
                    </div>

                    <div class="space-y-4">
                        <!-- Game Name -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-gamepad text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Game</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $game['nama_game'] }}</p>
                            </div>
                        </div>

                        <!-- Publisher -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-building text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Publisher</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $game['publisher'] }}</p>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="flex items-start">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3 mt-1">
                                <i class="fas fa-info-circle text-green-600"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500 mb-1">Deskripsi</p>
                                <p class="text-gray-900 leading-relaxed">{{ $game['description'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>

                    <div class="space-y-4">
                        <!-- Stock Status -->
                        <div class="text-center p-4 rounded-lg {{ $game['stock'] > 0 ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                            <div class="text-2xl font-bold {{ $game['stock'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $game['stock'] }}
                            </div>
                            <div class="text-sm text-gray-600">Stock Tersedia</div>
                            <div class="mt-1">
                                @if($game['stock'] > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Tersedia
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                        Habis
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Price -->
                        @if($game['harga'])
                            <div class="text-center p-4 bg-blue-50 border border-blue-200 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600">
                                    Rp {{ number_format($game['harga'], 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-gray-600">Harga</div>
                            </div>
                        @else
                            <div class="text-center p-4 bg-gray-50 border border-gray-200 rounded-lg">
                                <div class="text-lg font-medium text-gray-500">
                                    <i class="fas fa-minus mr-2"></i>
                                    Belum Diatur
                                </div>
                                <div class="text-sm text-gray-600">Harga</div>
                            </div>
                        @endif

                        <!-- Timestamps -->
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Dibuat:</span>
                                <span class="text-gray-900">{{ \Carbon\Carbon::parse($game['created_at'])->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Diperbarui:</span>
                                <span class="text-gray-900">{{ \Carbon\Carbon::parse($game['updated_at'])->format('d M Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-md p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi Cepat</h3>

                    <div class="space-y-3">
                        <a href="{{ route('games.topup', $game['id']) }}"
                           class="w-full bg-green-600 hover:bg-green-700 text-white text-center py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i>
                            Top-up Stock
                        </a>

                        <a href="{{ route('games.index') }}"
                           class="w-full bg-gray-600 hover:bg-gray-700 text-white text-center py-3 px-4 rounded-lg transition duration-150 ease-in-out flex items-center justify-center">
                            <i class="fas fa-list mr-2"></i>
                            Lihat Semua Game
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stock History (Placeholder) -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-history mr-2 text-blue-600"></i>
                Riwayat Stock
            </h3>

            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-chart-line text-4xl mb-4"></i>
                <p>Fitur riwayat stock akan tersedia dalam versi mendatang</p>
            </div>
        </div>
    </div>
</div>
@endsection
