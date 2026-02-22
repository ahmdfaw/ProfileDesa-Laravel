@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">Selamat Datang di {{ $profile->name ?? 'Website Dusun' }}</h1>
            <p class="text-xl">{{ $profile->vision ?? 'Mewujudkan dusun yang maju dan sejahtera' }}</p>
        </div>
    </div>

    <!-- Latest News -->
    @if ($latestNews->count() > 0)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900">Berita Terbaru</h2>
                <a href="{{ route('news.index') }}" class="text-blue-600 hover:text-blue-800">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($latestNews as $news)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if ($news->image)
                            <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">
                                <a href="{{ route('news.show', $news->slug) }}"
                                    class="hover:text-blue-600">{{ $news->title }}</a>
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($news->content, 100) }}</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>{{ $news->published_at->format('d M Y') }}</span>
                                <span>{{ $news->views }} views</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Services -->
    @if ($programs->count() > 0)
        <div class="bg-gray-100 py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-gray-900">Program Kegiatan</h2>
                    <a href="{{ route('programs.index') }}" class="text-blue-600 hover:text-blue-800">Lihat Semua</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($programs as $program)
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h3 class="text-xl font-semibold mb-2">{{ $program->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($program->description, 100) }}</p>
                            <a href="{{ route('programs.show', $program->id) }}"
                                class="text-blue-600 hover:text-blue-800">Selengkapnya →</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Gallery -->
    @if ($galleries->count() > 0)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-3xl font-bold text-gray-900">Galeri</h2>
                <a href="{{ route('gallery.index') }}" class="text-blue-600 hover:text-blue-800">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($galleries as $gallery)
                    <div class="relative overflow-hidden rounded-lg">
                        @if ($gallery->image)
                            <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                            <h3 class="font-semibold">{{ $gallery->title }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
