@extends('layouts.admin')

@section('title', 'Tambah Transaksi Keuangan PAM')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Transaksi Keuangan PAM</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.pam.keuangan.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="tanggal" class="mb-2 block text-sm font-medium text-gray-700">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', now()->toDateString()) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="jenis" class="mb-2 block text-sm font-medium text-gray-700">
                        Jenis <span class="text-red-500">*</span>
                    </label>
                    <select name="jenis" id="jenis"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('jenis') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="pemasukan" {{ old('jenis') === 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                        <option value="pengeluaran" {{ old('jenis') === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran
                        </option>
                    </select>
                    @error('jenis')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="kategori" class="mb-2 block text-sm font-medium text-gray-700">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="kategori" id="kategori" value="{{ old('kategori') }}"
                    placeholder="Contoh: Perbaikan Pipa, Pembelian Material, Gaji Petugas..."
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('kategori') border-red-500 @enderror"
                    required>
                @error('kategori')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="keterangan" class="mb-2 block text-sm font-medium text-gray-700">
                    Keterangan <span class="text-red-500">*</span>
                </label>
                <textarea name="keterangan" id="keterangan" rows="3"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror"
                    required>{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="jumlah" class="mb-2 block text-sm font-medium text-gray-700">
                    Jumlah (Rp) <span class="text-red-500">*</span>
                </label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah') }}" min="0"
                    step="100"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('jumlah') border-red-500 @enderror"
                    required>
                @error('jumlah')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.pam.keuangan.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
