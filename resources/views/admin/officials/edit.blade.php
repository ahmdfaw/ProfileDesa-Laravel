@extends('layouts.admin')

@section('title', 'Edit Pejabat')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Pejabat</h1>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.officials.update', $official->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Nama <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $official->name) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                    required>
                @error('name')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="position" class="mb-2 block text-sm font-medium text-gray-700">Jabatan <span
                        class="text-red-500">*</span></label>
                <input type="text" name="position" id="position" value="{{ old('position', $official->position) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('position') border-red-500 @enderror"
                    required>
                @error('position')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="photo" class="mb-2 block text-sm font-medium text-gray-700">Foto</label>
                @if ($official->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}"
                            class="h-32 w-32 rounded-full object-cover">
                    </div>
                @endif
                <input type="file" name="photo" id="photo" accept="image/*"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('photo') border-red-500 @enderror">
                @error('photo')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah foto.</p>
            </div>

            <div class="mb-4">
                <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone', $official->phone) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $official->email) }}"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="order" class="mb-2 block text-sm font-medium text-gray-700">Urutan <span
                        class="text-red-500">*</span></label>
                <input type="number" name="order" id="order" value="{{ old('order', $official->order) }}"
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
                <a href="{{ route('admin.officials.index') }}"
                    class="rounded-lg border border-gray-300 px-6 py-2 text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection
