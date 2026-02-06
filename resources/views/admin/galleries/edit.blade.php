@extends('layouts.admin')

@section('title', 'Edit Foto')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Foto</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="mb-2 block text-sm font-medium text-gray-700">Judul <span
                        class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $gallery->title) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                    required>
                @error('title')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="mb-2 block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $gallery->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="mb-2 block text-sm font-medium text-gray-700">Gambar</label>
                @if ($gallery->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                            class="h-48 w-auto object-cover">
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
                <label for="category" class="mb-2 block text-sm font-medium text-gray-700">Kategori <span
                        class="text-red-500">*</span></label>
                <input type="text" name="category" id="category" value="{{ old('category', $gallery->category) }}"
                    placeholder="Contoh: Kegiatan, Infrastruktur, Acara"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('category') border-red-500 @enderror"
                    required>
                @error('category')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="order" class="mb-2 block text-sm font-medium text-gray-700">Urutan <span
                        class="text-red-500">*</span></label>
                <input type="number" name="order" id="order" value="{{ old('order', $gallery->order) }}"
                    min="0"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('order') border-red-500 @enderror"
                    required>
                @error('order')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Urutan tampil (semakin kecil semakin awal)</p>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('admin.galleries.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
