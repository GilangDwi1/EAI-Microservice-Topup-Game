@extends('layouts.app')

@section('title', 'Top-up Stock - ' . $game['nama_game'])

@section('content')
<div class="max-w-4xl mx-auto">
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
                                <a href="{{ route('games.show', $game['id']) }}" class="text-sm font-medium text-gray-700 hover:text-purple-600">
                                    {{ $game['nama_game'] }}
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                                <span class="text-sm font-medium text-gray-500">Top-up Stock</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-bold text-gray-900 mt-2">
                    <i class="fas fa-plus-circle mr-3 text-green-600"></i>
                    Top-up Stock
                </h1>
                <p class="mt-2 text-gray-600">Tambah stock untuk game {{ $game['nama_game'] }}</p>
            </div>
            <a href="{{ route('games.show', $game['id']) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Top-up Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Form Top-up Stock</h2>

                    <form action="{{ route('games.topup.store', $game['id']) }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Current Stock Display -->
                        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Stock Saat Ini</p>
                                    <p class="text-2xl font-bold {{ $game['stock'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $game['stock'] }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-500">Status</p>
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
                        </div>

                        <!-- Amount Input -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-plus mr-2 text-green-500"></i>
                                Jumlah Stock yang Ditambahkan *
                            </label>
                            <div class="relative">
                                <input type="number"
                                       name="amount"
                                       id="amount"
                                       value="{{ old('amount') }}"
                                       min="1"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out"
                                       placeholder="Masukkan jumlah stock yang akan ditambahkan"
                                       required>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 text-sm">unit</span>
                                </div>
                            </div>
                            @error('amount')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview -->
                        <div id="preview" class="hidden bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h3 class="text-sm font-medium text-blue-800 mb-2">Preview Perubahan</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-blue-600">Stock Saat Ini:</span>
                                    <span class="font-medium">{{ $game['stock'] }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-blue-600">Ditambahkan:</span>
                                    <span class="font-medium" id="preview-amount">0</span>
                                </div>
                                <div class="flex justify-between border-t border-blue-200 pt-2">
                                    <span class="text-blue-800 font-medium">Stock Setelah Top-up:</span>
                                    <span class="font-bold text-blue-800" id="preview-total">{{ $game['stock'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('games.show', $game['id']) }}"
                               class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out">
                                <i class="fas fa-times mr-2"></i>
                                Batal
                            </a>
                            <button type="submit"
                                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out shadow-lg hover:shadow-xl">
                                <i class="fas fa-plus mr-2"></i>
                                Top-up Stock
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Game Info Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Game</h3>

                    <div class="space-y-4">
                        <!-- Game Name -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-gamepad text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Nama Game</p>
                                <p class="font-semibold text-gray-900">{{ $game['nama_game'] }}</p>
                            </div>
                        </div>

                        <!-- Publisher -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-building text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Publisher</p>
                                <p class="font-semibold text-gray-900">{{ $game['publisher'] }}</p>
                            </div>
                        </div>

                        <!-- Current Stock -->
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-boxes text-orange-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Stock Saat Ini</p>
                                <p class="font-semibold {{ $game['stock'] > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $game['stock'] }}
                                </p>
                            </div>
                        </div>

                        @if($game['harga'])
                            <!-- Price -->
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-tag text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Harga</p>
                                    <p class="font-semibold text-green-600">Rp {{ number_format($game['harga'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Help Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600 text-xl"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Informasi Top-up</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Top-up akan menambahkan stock ke game yang dipilih</li>
                                    <li>Stock tidak dapat dikurangi melalui fitur ini</li>
                                    <li>Perubahan akan langsung terlihat setelah top-up</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount');
    const preview = document.getElementById('preview');
    const previewAmount = document.getElementById('preview-amount');
    const previewTotal = document.getElementById('preview-total');
    const currentStock = {{ $game['stock'] }};

    amountInput.addEventListener('input', function() {
        const amount = parseInt(this.value) || 0;

        if (amount > 0) {
            previewAmount.textContent = amount;
            previewTotal.textContent = currentStock + amount;
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    });
});
</script>
@endsection
