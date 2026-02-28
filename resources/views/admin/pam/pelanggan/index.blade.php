@extends('layouts.admin')

@section('title', 'Kelola Pelanggan PAM')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Kelola Pelanggan PAM</h1>
        <a href="{{ route('admin.pam.pelanggan.create') }}"
            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Tambah Pelanggan
        </a>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">No. Meteran
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">RT/RW</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tarif/m³</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($pelanggan as $item)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $item->nomor_meteran }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $item->nama }}</div>
                            @if ($item->no_hp)
                                <div class="text-xs text-gray-500">{{ $item->no_hp }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-500">{{ Str::limit($item->alamat, 40) }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            RT {{ $item->rt }} / RW {{ $item->rw }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                            Rp {{ number_format($item->tarif_per_m3, 0, ',', '.') }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($item->status === 'aktif')
                                <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">
                                    Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.pam.pelanggan.edit', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('admin.pam.pelanggan.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                            Belum ada data pelanggan PAM.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pelanggan->links() }}
    </div>
@endsection
