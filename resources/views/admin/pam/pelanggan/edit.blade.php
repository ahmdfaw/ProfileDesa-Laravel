@extends('layouts.admin')

@section('title', 'Edit Pelanggan PAM')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Pelanggan PAM</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.pam.pelanggan.update', $pamPelanggan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="nomor_meteran" class="mb-2 block text-sm font-medium text-gray-700">
                        Nomor Meteran <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nomor_meteran" id="nomor_meteran"
                        value="{{ old('nomor_meteran', $pamPelanggan->nomor_meteran) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('nomor_meteran') border-red-500 @enderror"
                        required>
                    @error('nomor_meteran')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama" class="mb-2 block text-sm font-medium text-gray-700">
                        Nama Pelanggan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $pamPelanggan->nama) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                        required>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="alamat" class="mb-2 block text-sm font-medium text-gray-700">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <textarea name="alamat" id="alamat" rows="3"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('alamat') border-red-500 @enderror"
                    required>{{ old('alamat', $pamPelanggan->alamat) }}</textarea>
                @error('alamat')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="mb-4">
                    <label for="rt" class="mb-2 block text-sm font-medium text-gray-700">
                        RT <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rt" id="rt" value="{{ old('rt', $pamPelanggan->rt) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('rt') border-red-500 @enderror"
                        required>
                    @error('rt')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="rw" class="mb-2 block text-sm font-medium text-gray-700">
                        RW <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="rw" id="rw" value="{{ old('rw', $pamPelanggan->rw) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('rw') border-red-500 @enderror"
                        required>
                    @error('rw')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="no_hp" class="mb-2 block text-sm font-medium text-gray-700">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $pamPelanggan->no_hp) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('no_hp') border-red-500 @enderror">
                    @error('no_hp')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="mb-4">
                    <label for="tarif_per_m3" class="mb-2 block text-sm font-medium text-gray-700">
                        Tarif per m³ (Rp) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tarif_per_m3" id="tarif_per_m3"
                        value="{{ old('tarif_per_m3', $pamPelanggan->tarif_per_m3) }}" min="0" step="100"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('tarif_per_m3') border-red-500 @enderror"
                        required>
                    @error('tarif_per_m3')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="status" class="mb-2 block text-sm font-medium text-gray-700">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                        required>
                        <option value="aktif" {{ old('status', $pamPelanggan->status) === 'aktif' ? 'selected' : '' }}>
                            Aktif</option>
                        <option value="nonaktif"
                            {{ old('status', $pamPelanggan->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="catatan" class="mb-2 block text-sm font-medium text-gray-700">Catatan</label>
                <textarea name="catatan" id="catatan" rows="2"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('catatan') border-red-500 @enderror">{{ old('catatan', $pamPelanggan->catatan) }}</textarea>
                @error('catatan')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Perbarui
                </button>
                <a href="{{ route('admin.pam.pelanggan.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
