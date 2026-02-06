@extends('layouts.app')

@section('title', 'Galeri Desa')

@section('content')
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold">Galeri Desa</h1>
            <p class="text-xl mt-2">Dokumentasi kegiatan dan momen penting desa</p>
        </div>
    </div>

    <!-- Filter Categories -->
    @if ($categories->count() > 0)
        <div class="bg-white border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('gallery.index') }}"
                        class="px-4 py-2 rounded-lg {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Semua
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('gallery.index', ['category' => $category]) }}"
                            class="px-4 py-2 rounded-lg {{ request('category') == $category ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Gallery Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($galleries->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($galleries as $gallery)
                    <div
                        class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition duration-300">
                        @if ($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-64 object-cover group-hover:scale-110 transition duration-300">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        <!-- Overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <h3 class="font-bold text-lg mb-1">{{ $gallery->title }}</h3>
                                @if ($gallery->category)
                                    <span
                                        class="inline-block bg-blue-600 text-xs px-2 py-1 rounded">{{ $gallery->category }}</span>
                                @endif
                                @if ($gallery->description)
                                    <p class="text-sm mt-2 text-gray-200">{{ Str::limit($gallery->description, 60) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $galleries->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="text-gray-500 text-lg">Belum ada foto di galeri.</p>
            </div>
        @endif
    </div>
@endsection
