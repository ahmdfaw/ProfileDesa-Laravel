@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Beranda</a>
                <span class="mx-2 text-gray-500">/</span>
                <a href="{{ route('news.index') }}" class="text-blue-600 hover:text-blue-800">Berita</a>
                <span class="mx-2 text-gray-500">/</span>
                <span class="text-gray-500">{{ Str::limit($news->title, 50) }}</span>
            </nav>
        </div>
    </div>

    <!-- News Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            @if ($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}"
                    class="w-full h-96 object-cover">
            @endif

            <div class="p-8">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $news->title }}</h1>

                <div class="flex items-center text-gray-600 mb-6 pb-6 border-b">
                    <div class="flex items-center mr-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ $news->user->name }}
                    </div>
                    <div class="flex items-center mr-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $news->published_at->format('d F Y') }}
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        {{ $news->views }} views
                    </div>
                </div>

                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $news->content }}</p>
                </div>
            </div>
        </article>

        <!-- Related News -->
        @if ($relatedNews->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($relatedNews as $related)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            @if ($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}"
                                    class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-gray-300 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                            <div class="p-4">
                                <h3 class="font-semibold mb-2">
                                    <a href="{{ route('news.show', $related->slug) }}"
                                        class="hover:text-blue-600">{{ $related->title }}</a>
                                </h3>
                                <p class="text-sm text-gray-500">{{ $related->published_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Berita
            </a>
        </div>
    </div>
@endsection
