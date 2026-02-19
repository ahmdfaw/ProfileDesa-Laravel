@extends('layouts.admin')

@section('title', 'Edit Profil Dusun')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Profil Dusun</h1>
        <p class="text-gray-600">Kelola informasi profil dusun</p>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-lg bg-white p-6 shadow">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Informasi Dasar</h2>

                <div class="mb-4">
                    <label for="name" class="mb-2 block text-sm font-medium text-gray-700">Nama Dusun <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $profile->name) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="logo" class="mb-2 block text-sm font-medium text-gray-700">Logo Dusun</label>
                    @if ($profile->logo)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $profile->logo) }}" alt="Logo Dusun"
                                class="h-24 w-24 object-contain">
                        </div>
                    @endif
                    <input type="file" name="logo" id="logo" accept="image/*"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('logo') border-red-500 @enderror">
                    @error('logo')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-sm text-gray-500">Maksimal 1MB. Biarkan kosong jika tidak ingin mengubah logo.</p>
                </div>

                <div class="mb-4">
                    <label for="hamlet_head" class="mb-2 block text-sm font-medium text-gray-700">Kepala Dusun</label>
                    <input type="text" name="hamlet_head" id="hamlet_head"
                        value="{{ old('hamlet_head', $profile->hamlet_head) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('hamlet_head') border-red-500 @enderror">
                    @error('hamlet_head')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Sejarah dan Visi Misi</h2>

                <div class="mb-4">
                    <label for="history" class="mb-2 block text-sm font-medium text-gray-700">Sejarah Dusun</label>
                    <textarea name="history" id="history" rows="5"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('history') border-red-500 @enderror">{{ old('history', $profile->history) }}</textarea>
                    @error('history')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="vision" class="mb-2 block text-sm font-medium text-gray-700">Visi</label>
                    <textarea name="vision" id="vision" rows="3"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('vision') border-red-500 @enderror">{{ old('vision', $profile->vision) }}</textarea>
                    @error('vision')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="mission" class="mb-2 block text-sm font-medium text-gray-700">Misi</label>
                    <textarea name="mission" id="mission" rows="5"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('mission') border-red-500 @enderror">{{ old('mission', $profile->mission) }}</textarea>
                    @error('mission')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Geografis dan Demografi</h2>

                <div class="mb-4">
                    <label for="geographic_location" class="mb-2 block text-sm font-medium text-gray-700">Lokasi
                        Geografis</label>
                    <textarea name="geographic_location" id="geographic_location" rows="3"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('geographic_location') border-red-500 @enderror">{{ old('geographic_location', $profile->geographic_location) }}</textarea>
                    @error('geographic_location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="area" class="mb-2 block text-sm font-medium text-gray-700">Luas Wilayah</label>
                        <input type="text" name="area" id="area" value="{{ old('area', $profile->area) }}"
                            placeholder="Contoh: 150 Ha"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('area') border-red-500 @enderror">
                        @error('area')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="population" class="mb-2 block text-sm font-medium text-gray-700">Jumlah Penduduk</label>
                        <input type="number" name="population" id="population"
                            value="{{ old('population', $profile->population) }}" min="0"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('population') border-red-500 @enderror">
                        @error('population')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="total_rw" class="mb-2 block text-sm font-medium text-gray-700">Jumlah RW</label>
                        <input type="number" name="total_rw" id="total_rw"
                            value="{{ old('total_rw', $profile->total_rw) }}" min="0"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('total_rw') border-red-500 @enderror">
                        @error('total_rw')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="total_rt" class="mb-2 block text-sm font-medium text-gray-700">Jumlah RT</label>
                        <input type="number" name="total_rt" id="total_rt"
                            value="{{ old('total_rt', $profile->total_rt) }}" min="0"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('total_rt') border-red-500 @enderror">
                        @error('total_rt')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Informasi Kontak</h2>

                <div class="mb-4">
                    <label for="address" class="mb-2 block text-sm font-medium text-gray-700">Alamat</label>
                    <textarea name="address" id="address" rows="2"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('address') border-red-500 @enderror">{{ old('address', $profile->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label for="phone" class="mb-2 block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $profile->email) }}"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection
