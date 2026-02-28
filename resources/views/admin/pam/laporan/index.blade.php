@extends('layouts.admin')

@section('title', 'Laporan PAM')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Laporan PAM</h1>
    </div>

    <div class="mb-6 rounded-lg bg-white p-4 shadow">
        <form method="GET" action="{{ route('admin.pam.laporan.index') }}" class="flex flex-wrap items-end gap-4">
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Bulan</label>
                <select name="bulan" class="rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500">
                    @foreach ($namaBulan as $num => $nama)
                        <option value="{{ $num }}" {{ $bulan == $num ? 'selected' : '' }}>{{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="mb-1 block text-sm font-medium text-gray-700">Tahun</label>
                <input type="number" name="tahun" value="{{ $tahun }}" min="2000" max="2100"
                    class="w-24 rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500">
            </div>
            <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">Tampilkan</button>
        </form>
    </div>

    <h2 class="mb-4 text-lg font-semibold text-gray-900">
        Laporan {{ $namaBulan[$bulan] }} {{ $tahun }}
    </h2>

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <div class="rounded-lg bg-blue-50 p-4 shadow">
            <p class="text-sm text-blue-600">Total Pelanggan Tagihan</p>
            <p class="text-2xl font-bold text-blue-800">{{ $totalTagihan }}</p>
        </div>
        <div class="rounded-lg bg-green-50 p-4 shadow">
            <p class="text-sm text-green-600">Sudah Lunas</p>
            <p class="text-2xl font-bold text-green-800">{{ $sudahBayar }}</p>
            <p class="text-sm text-green-600">Rp {{ number_format($nominalLunas, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-lg bg-red-50 p-4 shadow">
            <p class="text-sm text-red-600">Belum Bayar</p>
            <p class="text-2xl font-bold text-red-800">{{ $belumBayar }}</p>
            <p class="text-sm text-red-600">Rp {{ number_format($nominalBelumBayar, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-lg bg-green-100 p-4 shadow">
            <p class="text-sm text-green-700">Total Pemasukan</p>
            <p class="text-xl font-bold text-green-900">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-lg bg-red-100 p-4 shadow">
            <p class="text-sm text-red-700">Total Pengeluaran</p>
            <p class="text-xl font-bold text-red-900">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
        </div>
        <div class="rounded-lg {{ $saldo >= 0 ? 'bg-blue-100' : 'bg-orange-100' }} p-4 shadow">
            <p class="text-sm {{ $saldo >= 0 ? 'text-blue-700' : 'text-orange-700' }}">Saldo Bulan Ini</p>
            <p class="text-xl font-bold {{ $saldo >= 0 ? 'text-blue-900' : 'text-orange-900' }}">
                Rp {{ number_format(abs($saldo), 0, ',', '.') }}
                {{ $saldo < 0 ? '(Defisit)' : '' }}
            </p>
        </div>
    </div>

    <div class="mb-8">
        <h3 class="mb-3 text-base font-semibold text-gray-900">Daftar Tagihan</h3>
        @if ($tagihan->isEmpty())
            <p class="rounded-lg bg-gray-50 p-4 text-sm text-gray-500">Tidak ada tagihan pada periode ini.</p>
        @else
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Pelanggan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Pemakaian</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Total
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($tagihan as $item)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->pelanggan->nama }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->pelanggan->nomor_meteran }}</div>
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900">
                                    {{ number_format($item->pemakaian, 2, ',', '.') }} m³
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium text-gray-900">
                                    Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}
                                </td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    @if ($item->status === 'sudah_bayar')
                                        <span
                                            class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Lunas</span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">Belum
                                            Bayar</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div>
        <h3 class="mb-3 text-base font-semibold text-gray-900">Transaksi Keuangan</h3>
        @if ($keuangan->isEmpty())
            <p class="rounded-lg bg-gray-50 p-4 text-sm text-gray-500">Tidak ada transaksi keuangan pada periode ini.</p>
        @else
            <div class="overflow-hidden rounded-lg bg-white shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Jenis
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Keterangan</th>
                            <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach ($keuangan as $item)
                            <tr>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-500">
                                    {{ $item->tanggal->format('d M Y') }}</td>
                                <td class="whitespace-nowrap px-4 py-3">
                                    @if ($item->jenis === 'pemasukan')
                                        <span
                                            class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Pemasukan</span>
                                    @else
                                        <span
                                            class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">Pengeluaran</span>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900">{{ $item->kategori }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ Str::limit($item->keterangan, 50) }}</td>
                                <td class="whitespace-nowrap px-4 py-3 text-sm font-medium">
                                    <span class="{{ $item->jenis === 'pemasukan' ? 'text-green-700' : 'text-red-700' }}">
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
