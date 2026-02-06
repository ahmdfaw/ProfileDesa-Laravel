@extends('layouts.app')

@section('title', $service->name)

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm">
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Beranda</a>
                <span class="mx-2 text-gray-500">/</span>
                <a href="{{ route('services.index') }}" class="text-blue-600 hover:text-blue-800">Layanan</a>
                <span class="mx-2 text-gray-500">/</span>
                <span class="text-gray-500">{{ $service->name }}</span>
            </nav>
        </div>
    </div>

    <!-- Service Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-600 text-white p-8 flex items-center">
                @if ($service->icon)
                    <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}" class="w-20 h-20 mr-6">
                @else
                    <svg class="w-20 h-20 mr-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                            clip-rule="evenodd" />
                    </svg>
                @endif
                <div>
                    <h1 class="text-3xl font-bold">{{ $service->name }}</h1>
                    <p class="text-blue-100 mt-2">{{ $service->description }}</p>
                </div>
            </div>

            <!-- Details -->
            <div class="p-8 space-y-6">
                <!-- Processing Time & Cost -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if ($service->processing_time)
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <div class="flex items-center text-blue-900 mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold">Waktu Proses</span>
                            </div>
                            <p class="text-gray-700">{{ $service->processing_time }}</p>
                        </div>
                    @endif

                    @if ($service->cost)
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="flex items-center text-green-900 mb-2">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-semibold">Biaya</span>
                            </div>
                            <p class="text-gray-700">{{ $service->cost }}</p>
                        </div>
                    @endif
                </div>

                <!-- Requirements -->
                @if ($service->requirements)
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Persyaratan
                        </h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 whitespace-pre-line">{{ $service->requirements }}</p>
                        </div>
                    </div>
                @endif

                <!-- Procedure -->
                @if ($service->procedure)
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                            Prosedur
                        </h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-gray-700 whitespace-pre-line">{{ $service->procedure }}</p>
                        </div>
                    </div>
                @endif

                <!-- Contact Info -->
                <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-600">
                    <h3 class="font-bold text-blue-900 mb-2">Informasi Lebih Lanjut</h3>
                    <p class="text-gray-700">Untuk informasi lebih lanjut mengenai layanan ini, silakan hubungi kantor desa
                        atau datang langsung ke kantor desa.</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
            <a href="{{ route('services.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Layanan
            </a>
        </div>
    </div>
@endsection
