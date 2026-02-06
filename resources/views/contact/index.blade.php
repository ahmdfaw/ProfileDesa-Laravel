@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
    <!-- Hero Section -->
    <div class="bg-blue-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold">Hubungi Kami</h1>
            <p class="text-xl mt-2">Sampaikan pesan, saran, atau pertanyaan Anda</p>
        </div>
    </div>

    <!-- Contact Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-md p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="block text-gray-700 font-semibold mb-2">Subjek</label>
                        <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('subject') border-red-500 @enderror"
                            required>
                        @error('subject')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-semibold mb-2">Pesan</label>
                        <textarea name="message" id="message" rows="6"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('message') border-red-500 @enderror"
                            required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200 font-semibold">
                        Kirim Pesan
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="space-y-6">
                <!-- Office Info -->
                <div class="bg-white rounded-lg shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>

                    @if ($profile)
                        <div class="space-y-4">
                            @if ($profile->address)
                                <div class="flex items-start">
                                    <div class="bg-blue-100 rounded-full p-3 mr-4">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Alamat</h3>
                                        <p class="text-gray-600 mt-1">{{ $profile->address }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($profile->phone)
                                <div class="flex items-start">
                                    <div class="bg-blue-100 rounded-full p-3 mr-4">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Telepon</h3>
                                        <p class="text-gray-600 mt-1">{{ $profile->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($profile->email)
                                <div class="flex items-start">
                                    <div class="bg-blue-100 rounded-full p-3 mr-4">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900">Email</h3>
                                        <p class="text-gray-600 mt-1">{{ $profile->email }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-600">Informasi kontak belum tersedia.</p>
                    @endif
                </div>

                <!-- Office Hours -->
                <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-600">
                    <h3 class="font-bold text-blue-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Jam Pelayanan
                    </h3>
                    <div class="text-gray-700 space-y-1">
                        <p>Senin - Kamis: 08:00 - 15:00 WIB</p>
                        <p>Jumat: 08:00 - 11:30 WIB</p>
                        <p class="text-sm text-gray-600 mt-2">* Kecuali hari libur nasional</p>
                    </div>
                </div>

                <!-- Map Placeholder -->
                <div class="bg-white rounded-lg shadow-md p-4">
                    <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                        <div class="text-center text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            <p>Peta lokasi kantor desa</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
