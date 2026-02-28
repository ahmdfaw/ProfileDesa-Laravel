@extends('layouts.admin')

@section('title', 'Keuangan PAM')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Keuangan PAM</h1>
        <a href="{{ route('admin.pam.keuangan.create') }}"
            class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
            Tambah Transaksi
        </a>
    </div>

    <div class="mb-4 rounded-lg bg-white p-4 shadow">
        <form method="GET" action="{{ route('admin.pam.keuangan.index') }}" class="flex flex-wrap gap-3">
            <div>
                <select name="jenis" class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500">
                    <option value="">Semua Jenis</option>
                    <option value="pemasukan" {{ request('jenis') === 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="pengeluaran" {{ request('jenis') === 'pengeluaran' ? 'selected' : '' }}>Pengeluaran
                    </option>
                </select>
            </div>
            <div>
                <select name="bulan" class="rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500">
                    <option value="">Semua Bulan</option>
                    @foreach ($namaBulan as $num => $nama)
                        <option value="{{ $num }}" {{ request('bulan') == $num ? 'selected' : '' }}>
                            {{ $nama }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <input type="number" name="tahun" value="{{ request('tahun') }}" placeholder="Tahun"
                    class="w-24 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-blue-500">
            </div>
            <button type="submit"
                class="rounded-lg bg-gray-600 px-4 py-2 text-sm text-white hover:bg-gray-700">Filter</button>
            <a href="{{ route('admin.pam.keuangan.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Reset</a>
        </form>
    </div>

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="rounded-lg bg-green-50 p-4 shadow">
            <p class="text-sm text-green-600">Total Pemasukan</p>
            <p class="text-xl font-bold text-green-800">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-lg bg-red-50 p-4 shadow">
            <p class="text-sm text-red-600">Total Pengeluaran</p>
            <p class="text-xl font-bold text-red-800">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-lg bg-blue-50 p-4 shadow">
            <p class="text-sm text-blue-600">Saldo</p>
            <p class="text-xl font-bold text-blue-800">Rp
                {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Keterangan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jumlah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                @forelse ($transaksi as $item)
                    <tr>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                            {{ $item->tanggal->format('d M Y') }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            @if ($item->jenis === 'pemasukan')
                                <span
                                    class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Pemasukan</span>
                            @else
                                <span
                                    class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">Pengeluaran</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                            {{ $item->kategori }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ Str::limit($item->keterangan, 50) }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                            <span class="{{ $item->jenis === 'pemasukan' ? 'text-green-700' : 'text-red-700' }}">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4 text-sm font-medium">
                            <div class="flex space-x-2">
                                @if (!$item->tagihan_id)
                                    <a href="{{ route('admin.pam.keuangan.edit', $item->id) }}"
                                        class="text-blue-600 hover:text-blue-900">Edit</a>
                                    <form action="{{ route('admin.pam.keuangan.destroy', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400">Otomatis dari tagihan</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                            Belum ada data transaksi keuangan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $transaksi->links() }}
    </div>
@endsection
