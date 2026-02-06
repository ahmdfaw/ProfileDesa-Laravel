@extends('layouts.admin')

@section('title', 'Tambah Berita Baru')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Tambah Berita Baru</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="title" class="mb-2 block text-sm font-medium text-gray-700">Judul <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                    required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="mb-2 block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Maksimal 2MB</p>
            </div>

            <div class="mb-4">
                <label for="content" class="mb-2 block text-sm font-medium text-gray-700">Konten <span
                        class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="10"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                    required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Publikasikan sekarang</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.news.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
