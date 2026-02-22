@extends('layouts.admin')

@section('title', 'Tambah Program Baru')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Program Baru</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Nama Program <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="mb-2 block text-sm font-medium text-gray-700">Deskripsi <span
                        class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="3"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="icon" class="mb-2 block text-sm font-medium text-gray-700">Icon</label>
                <input type="file" name="icon" id="icon" accept="image/*"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('icon') border-red-500 @enderror">
                @error('icon')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Maksimal 1MB</p>
            </div>

            <div class="mb-4">
                <label for="requirements" class="mb-2 block text-sm font-medium text-gray-700">Target Peserta /
                    Persyaratan</label>
                <textarea name="requirements" id="requirements" rows="4"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('requirements') border-red-500 @enderror">{{ old('requirements') }}</textarea>
                @error('requirements')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="procedure" class="mb-2 block text-sm font-medium text-gray-700">Alur Kegiatan</label>
                <textarea name="procedure" id="procedure" rows="4"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('procedure') border-red-500 @enderror">{{ old('procedure') }}</textarea>
                @error('procedure')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="processing_time" class="mb-2 block text-sm font-medium text-gray-700">Jadwal Pelaksanaan</label>
                <input type="text" name="processing_time" id="processing_time" value="{{ old('processing_time') }}"
                    placeholder="Contoh: Setiap minggu ke-2 bulan berjalan"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('processing_time') border-red-500 @enderror">
                @error('processing_time')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cost" class="mb-2 block text-sm font-medium text-gray-700">Penanggungjawab</label>
                <input type="text" name="cost" id="cost" value="{{ old('cost') }}"
                    placeholder="Contoh: Kadus / RT 01"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('cost') border-red-500 @enderror">
                @error('cost')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="order" class="mb-2 block text-sm font-medium text-gray-700">Urutan <span
                        class="text-red-500">*</span></label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('order') border-red-500 @enderror"
                    required>
                @error('order')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Urutan tampil (semakin kecil semakin awal)</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.programs.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
