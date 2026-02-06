@extends('layouts.app')

@section('title', 'Berita Desa')

@section('content')
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold">Berita Desa</h1>
            <p class="text-xl mt-2">Informasi terkini dari desa</p>
        </div>
    </div>

    <!-- News Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($news as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                        @if ($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $item->published_at->format('d M Y') }}
                                <span class="mx-2">•</span>
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $item->views }} views
                            </div>
                            <h3 class="text-xl font-semibold mb-2">
                                <a href="{{ route('news.show', $item->slug) }}"
                                    class="hover:text-blue-600">{{ $item->title }}</a>
                            </h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($item->content, 120) }}</p>
                            <a href="{{ route('news.show', $item->slug) }}"
                                class="text-blue-600 hover:text-blue-800 font-semibold">
                                Selengkapnya →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada berita yang dipublikasikan.</p>
            </div>
        @endif
    </div>
@endsection
