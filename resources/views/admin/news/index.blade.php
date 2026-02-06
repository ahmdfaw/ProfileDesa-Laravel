@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Berita</h1>
        <a href="{{ route('admin.news.create') }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Tambah Berita Baru
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
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Penulis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Views</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($news as $item)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($item->title, 50) }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="text-sm text-gray-500">{{ $item->user->name }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($item->is_published)
                                <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                    Dipublikasi
                                </span>
                            @else
                                <span class="rounded-full bg-yellow-100 px-2 py-1 text-xs font-semibold text-yellow-800">
                                    Draft
                                </span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $item->views }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.news.edit', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('admin.news.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
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
                            Belum ada berita.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $news->links() }}
    </div>
@endsection
