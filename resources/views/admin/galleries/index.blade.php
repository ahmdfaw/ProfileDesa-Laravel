@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Galeri</h1>
        <a href="{{ route('admin.galleries.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Tambah Foto Baru
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($galleries as $gallery)
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                    class="h-48 w-full object-cover">
                <div class="p-4">
                    <h3 class="mb-1 text-lg font-semibold text-gray-900">{{ $gallery->title }}</h3>
                    <p class="mb-2 text-sm text-gray-600">{{ Str::limit($gallery->description, 80) }}</p>
                    <div class="mb-3 flex items-center justify-between text-sm text-gray-500">
                        <span class="rounded-full bg-blue-100 px-2 py-1 text-xs font-semibold text-blue-800">
                            {{ $gallery->category }}
                        </span>
                        <span>Urutan: {{ $gallery->order }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                            class="flex-1 rounded bg-blue-600 px-3 py-2 text-center text-sm text-white hover:bg-blue-700">
                            Edit
                        </a>
                        <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full rounded bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full rounded-lg bg-white p-12 text-center shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="mt-2 text-gray-500">Belum ada foto di galeri.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $galleries->links() }}
    </div>
@endsection
