@extends('layouts.app')

@section('title', 'Profil Dusun')

@section('content')
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold">Profil {{ $profile->name ?? 'Dusun' }}</h1>
        </div>
    </div>

    <!-- Profile Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Sejarah -->
                @if ($profile && $profile->history)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Sejarah Dusun</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->history }}</p>
                    </div>
                @endif

                <!-- Visi -->
                @if ($profile && $profile->vision)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Visi</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->vision }}</p>
                    </div>
                @endif

                <!-- Misi -->
                @if ($profile && $profile->mission)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Misi</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->mission }}</p>
                    </div>
                @endif

                <!-- Letak Geografis -->
                @if ($profile && $profile->geographic_location)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Letak Geografis</h2>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->geographic_location }}</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Info Desa -->
                @if ($profile)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Informasi Dusun</h3>
                        <div class="space-y-3">
                            @if ($profile->area)
                                <div>
                                    <p class="text-sm text-gray-500">Luas Wilayah</p>
                                    <p class="font-semibold">{{ $profile->area }}</p>
                                </div>
                            @endif
                            @if ($profile->population)
                                <div>
                                    <p class="text-sm text-gray-500">Jumlah Penduduk</p>
                                    <p class="font-semibold">{{ number_format($profile->population) }} jiwa</p>
                                </div>
                            @endif
                            @if ($profile->total_rw)
                                <div>
                                    <p class="text-sm text-gray-500">Jumlah RW</p>
                                    <p class="font-semibold">{{ $profile->total_rw }} RW</p>
                                </div>
                            @endif
                            @if ($profile->total_rt)
                                <div>
                                    <p class="text-sm text-gray-500">Jumlah RT</p>
                                    <p class="font-semibold">{{ $profile->total_rt }} RT</p>
                                </div>
                            @endif
                            @if ($profile->hamlet_head)
                                <div>
                                    <p class="text-sm text-gray-500">Kepala Dusun</p>
                                    <p class="font-semibold">{{ $profile->hamlet_head }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Kontak -->
                @if ($profile)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Kontak</h3>
                        <div class="space-y-3">
                            @if ($profile->address)
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gray-500 mt-1 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-gray-700">{{ $profile->address }}</p>
                                </div>
                            @endif
                            @if ($profile->phone)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <p class="text-gray-700">{{ $profile->phone }}</p>
                                </div>
                            @endif
                            @if ($profile->email)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-gray-700">{{ $profile->email }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Struktur Organisasi -->
        @if ($officials->count() > 0)
            <div class="mt-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Struktur Pemerintahan Dusun</h2>

                @php $grouped = $officials->groupBy('type'); @endphp

                {{-- Kepala Dusun --}}
                @if ($grouped->has('kadus'))
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Kepala Dusun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        @foreach ($grouped['kadus'] as $official)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if ($official->photo)
                                    <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-4 text-center">
                                    <h3 class="font-bold text-lg text-gray-900">{{ $official->name }}</h3>
                                    <p class="text-gray-600">{{ $official->position }}</p>
                                    @if ($official->phone || $official->email)
                                        <div class="mt-3 text-sm text-gray-500">
                                            @if ($official->phone)
                                                <p>{{ $official->phone }}</p>
                                            @endif
                                            @if ($official->email)
                                                <p>{{ $official->email }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- RW --}}
                @if ($grouped->has('rw'))
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Rukun Warga (RW)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        @foreach ($grouped['rw'] as $official)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if ($official->photo)
                                    <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-4 text-center">
                                    <h3 class="font-bold text-lg text-gray-900">{{ $official->name }}</h3>
                                    <p class="text-gray-600">{{ $official->position }}</p>
                                    @if ($official->phone || $official->email)
                                        <div class="mt-3 text-sm text-gray-500">
                                            @if ($official->phone)
                                                <p>{{ $official->phone }}</p>
                                            @endif
                                            @if ($official->email)
                                                <p>{{ $official->email }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- RT --}}
                @if ($grouped->has('rt'))
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Rukun Tetangga (RT)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($grouped['rt'] as $official)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                @if ($official->photo)
                                    <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-4 text-center">
                                    <h3 class="font-bold text-lg text-gray-900">{{ $official->name }}</h3>
                                    <p class="text-gray-600">{{ $official->position }}</p>
                                    @if ($official->phone || $official->email)
                                        <div class="mt-3 text-sm text-gray-500">
                                            @if ($official->phone)
                                                <p>{{ $official->phone }}</p>
                                            @endif
                                            @if ($official->email)
                                                <p>{{ $official->email }}</p>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        @endif
    </div>
@endsection
