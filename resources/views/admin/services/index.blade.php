@extends('layouts.admin')

@section('title', 'Kelola Layanan')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Layanan</h1>
        <a href="{{ route('admin.services.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Tambah Layanan Baru
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Waktu Proses
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Biaya</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Urutan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($services as $service)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($service->icon)
                                <img src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}"
                                    class="h-10 w-10 object-contain">
                            @else
                                <div class="flex h-10 w-10 items-center justify-center bg-gray-100">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $service->name }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($service->description, 50) }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $service->processing_time ?? '-' }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $service->cost ?? '-' }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $service->order }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.services.edit', $service->id) }}"
                                    class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            Belum ada data layanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $services->links() }}
    </div>
@endsection
