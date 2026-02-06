@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Berita</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="mb-2 block text-sm font-medium text-gray-700">Judul <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                    required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="mb-2 block text-sm font-medium text-gray-700">Gambar</label>
                @if ($news->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="h-32 w-auto">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.</p>
            </div>

            <div class="mb-4">
                <label for="content" class="mb-2 block text-sm font-medium text-gray-700">Konten <span
                        class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="10"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('content') border-red-500 @enderror"
                    required>{{ old('content', $news->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_published" value="1"
                        {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Publikasikan</span>
                </label>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('admin.news.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
