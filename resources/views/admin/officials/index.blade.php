@extends('layouts.admin')

@section('title', 'Kelola Pemerintahan')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Pemerintahan</h1>
        <a href="{{ route('admin.officials.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Tambah Pejabat Baru
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
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kontak</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Urutan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($officials as $official)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($official->photo)
                                <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}"
                                    class="h-12 w-12 rounded-full object-cover">
                            @else
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-200">
                                    <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $official->name }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="text-sm text-gray-500">{{ $official->position }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">
                                @if ($official->phone)
                                    <div>{{ $official->phone }}</div>
                                @endif
                                @if ($official->email)
                                    <div>{{ $official->email }}</div>
                                @endif
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $official->order }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.officials.edit', $official->id) }}"
                                    class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('admin.officials.destroy', $official->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus pejabat ini?')">
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
                            Belum ada data pemerintahan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $officials->links() }}
    </div>
@endsection
