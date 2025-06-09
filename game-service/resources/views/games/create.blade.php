@extends('layouts.app')

@section('title', 'Tambah Game Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    <i class="fas fa-plus-circle mr-3 text-purple-600"></i>
                    Tambah Game Baru
                </h1>
                <p class="mt-2 text-gray-600">Masukkan informasi game yang akan ditambahkan ke sistem</p>
            </div>
            <a href="{{ route('games.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('games.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Game Name -->
                <div>
                    <label for="nama_game" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-gamepad mr-2 text-purple-500"></i>
                        Nama Game *
                    </label>
                    <input type="text"
                           name="nama_game"
                           id="nama_game"
                           value="{{ old('nama_game') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition duration-150 ease-in-out"
                           placeholder="Masukkan nama game"
                           required>
                    @error('nama_game')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Publisher -->
                <div>
                    <label for="publisher" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-building mr-2 text-blue-500"></i>
                        Publisher *
                    </label>
                    <input type="text"
                           name="publisher"
                           id="publisher"
                           value="{{ old('publisher') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="Masukkan nama publisher"
                           required>
                    @error('publisher')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-info-circle mr-2 text-green-500"></i>
                        Deskripsi *
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out"
                              placeholder="Masukkan deskripsi game"
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stock and Price Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Stock -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-boxes mr-2 text-orange-500"></i>
                            Stock *
                        </label>
                        <input type="number"
                               name="stock"
                               id="stock"
                               value="{{ old('stock') }}"
                               min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition duration-150 ease-in-out"
                               placeholder="Masukkan jumlah stock"
                               required>
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tag mr-2 text-green-500"></i>
                            Harga (Opsional)
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
                                Rp
                            </span>
                            <input type="number"
                                   name="harga"
                                   id="harga"
                                   value="{{ old('harga') }}"
                                   min="0"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 ease-in-out"
                                   placeholder="Masukkan harga">
                        </div>
                        @error('harga')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="{{ route('games.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                            class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out shadow-lg hover:shadow-xl">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Game
                    </button>
                </div>
            </form>
        </div>

        <!-- Help Card -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-lightbulb text-blue-600 text-xl"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Tips Pengisian</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Pastikan nama game unik dan mudah diingat</li>
                            <li>Deskripsi yang jelas akan membantu pengguna memahami game</li>
                            <li>Stock awal bisa diatur sesuai kebutuhan</li>
                            <li>Harga bersifat opsional dan bisa diatur nanti</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
