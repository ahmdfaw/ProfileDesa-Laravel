@extends('layouts.admin')

@section('title', 'Tagihan PAM')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Tagihan PAM</h1>
        <a href="{{ route('admin.pam.tagihan.create') }}"
            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Catat Tagihan Baru
        </a>
    </div>

    <div class="mb-4 rounded-lg bg-white p-4 shadow">
        <form method="GET" action="{{ route('admin.pam.tagihan.index') }}" class="flex flex-wrap gap-3">
            <div>
                <select name="bulan"
                    class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Bulan</option>
                    @foreach ($namaBulan as $num => $nama)
                        <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                            {{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="number" name="tahun" value="{{ request('tahun') }}" placeholder="Tahun"
                    class="w-24 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <select name="status"
                    class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="belum_bayar" {{ request('status') === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar
                    </option>
                    <option value="sudah_bayar" {{ request('status') === 'sudah_bayar' ? 'selected' : '' }}>Sudah Bayar
                    </option>
                </select>
            </div>
            <button type="submit"
                class="rounded-lg bg-gray-600 px-4 py-2 text-sm text-white hover:bg-gray-700">Filter</button>
            <a href="{{ route('admin.pam.tagihan.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Reset</a>
        </form>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Pelanggan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Periode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Pemakaian
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Total Tagihan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($tagihan as $item)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $item->pelanggan->nama }}</div>
                            <div class="text-xs text-gray-500">{{ $item->pelanggan->nomor_meteran }}</div>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                            {{ $namaBulan[$item->bulan] }} {{ $item->tahun }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                            {{ number_format($item->pemakaian, 2, ',', '.') }} m³
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                            Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($item->status === 'sudah_bayar')
                                <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                    Lunas
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">
                                    Belum Bayar
                                </span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('admin.pam.tagihan.show', $item->id) }}"
                                    class="text-gray-600 hover:text-gray-900">Detail</a>
                                <a href="{{ route('admin.pam.tagihan.cetak', $item->id) }}" target="_blank"
                                    class="text-purple-600 hover:text-purple-900">Cetak</a>
                                @if ($item->status === 'belum_bayar')
                                    <form action="{{ route('admin.pam.tagihan.tandai-lunas', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Tandai tagihan ini sudah lunas?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-green-600 hover:text-green-900">Tandai
                                            Lunas</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.pam.tagihan.edit', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-900">Edit</a>
                                <form action="{{ route('admin.pam.tagihan.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus tagihan ini?')">
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
                            Belum ada data tagihan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tagihan->links() }}
    </div>
@endsection
