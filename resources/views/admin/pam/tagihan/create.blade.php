@extends('layouts.admin')

@section('title', 'Catat Tagihan PAM')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Catat Tagihan PAM</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.pam.tagihan.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="pelanggan_id" class="mb-2 block text-sm font-medium text-gray-700">
                    Pelanggan <span class="text-red-500">*</span>
                </label>
                <select name="pelanggan_id" id="pelanggan_id"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('pelanggan_id') border-red-500 @enderror"
                    required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach ($pelanggan as $p)
                        <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nomor_meteran }} - {{ $p->nama }} (RT {{ $p->rt }}/RW {{ $p->rw }})
                        </option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="bulan" class="mb-2 block text-sm font-medium text-gray-700">
                        Bulan <span class="text-red-500">*</span>
                    </label>
                    <select name="bulan" id="bulan"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('bulan') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Bulan --</option>
                        @foreach ($namaBulan as $num => $nama)
                            <option value="{{ $num }}" {{ old('bulan') == $num ? 'selected' : '' }}>
                                {{ $nama }}</option>
                        @endforeach
                    </select>
                    @error('bulan')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tahun" class="mb-2 block text-sm font-medium text-gray-700">
                        Tahun <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tahun" id="tahun" value="{{ old('tahun', now()->year) }}"
                        min="2000" max="2100"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('tahun') border-red-500 @enderror"
                        required>
                    @error('tahun')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="angka_awal" class="mb-2 block text-sm font-medium text-gray-700">
                        Angka Meteran Awal <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="angka_awal" id="angka_awal" value="{{ old('angka_awal') }}" min="0"
                        step="0.01"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('angka_awal') border-red-500 @enderror"
                        required>
                    @error('angka_awal')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="angka_akhir" class="mb-2 block text-sm font-medium text-gray-700">
                        Angka Meteran Akhir <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="angka_akhir" id="angka_akhir" value="{{ old('angka_akhir') }}"
                        min="0" step="0.01"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('angka_akhir') border-red-500 @enderror"
                        required>
                    @error('angka_akhir')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Pemakaian = angka akhir - angka awal</p>
                </div>
            </div>

            <div class="mb-6">
                <label for="keterangan" class="mb-2 block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="2"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.pam.tagihan.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
