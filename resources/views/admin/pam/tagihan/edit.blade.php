@extends('layouts.admin')

@section('title', 'Edit Tagihan PAM')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Tagihan PAM</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <div class="mb-6 rounded-lg bg-gray-50 p-4">
            <p class="text-sm text-gray-600">
                <span class="font-medium">Pelanggan:</span> {{ $pamTagihan->pelanggan->nama }}
                ({{ $pamTagihan->pelanggan->nomor_meteran }})
            </p>
            <p class="text-sm text-gray-600">
                <span class="font-medium">Periode:</span> {{ $namaBulan[$pamTagihan->bulan] }} {{ $pamTagihan->tahun }}
            </p>
            <p class="text-sm text-gray-600">
                <span class="font-medium">Tarif saat catat:</span> Rp
                {{ number_format($pamTagihan->tarif_saat_catat, 0, ',', '.') }}/m³
            </p>
        </div>

        <form action="{{ route('admin.pam.tagihan.update', $pamTagihan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="angka_awal" class="mb-2 block text-sm font-medium text-gray-700">
                        Angka Meteran Awal <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="angka_awal" id="angka_awal"
                        value="{{ old('angka_awal', $pamTagihan->angka_awal) }}" min="0" step="0.01"
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
                    <input type="number" name="angka_akhir" id="angka_akhir"
                        value="{{ old('angka_akhir', $pamTagihan->angka_akhir) }}" min="0" step="0.01"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('angka_akhir') border-red-500 @enderror"
                        required>
                    @error('angka_akhir')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="keterangan" class="mb-2 block text-sm font-medium text-gray-700">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="2"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan', $pamTagihan->keterangan) }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Perbarui
                </button>
                <a href="{{ route('admin.pam.tagihan.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
