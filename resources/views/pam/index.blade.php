@extends('layouts.app')

@section('title', 'Cek Tagihan PAM')

@section('content')
    <div class="bg-blue-600 py-12 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold">Cek Tagihan Air (PAM)</h1>
            <p class="mt-2 text-xl">Cek tagihan dan riwayat pembayaran air bersih Anda</p>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-2xl">
            <div class="rounded-lg bg-white p-8 shadow-md">
                <h2 class="mb-6 text-2xl font-bold text-gray-900">Cari Data Pelanggan</h2>
                <form method="GET" action="{{ route('pam.index') }}">
                    <div class="mb-4">
                        <label for="cari" class="mb-2 block font-semibold text-gray-700">
                            Nomor Meteran atau Nama Pelanggan
                        </label>
                        <input type="text" name="cari" id="cari" value="{{ $keyword }}"
                            placeholder="Masukkan nomor meteran atau nama..."
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-blue-500 focus:outline-none">
                    </div>
                    <button type="submit"
                        class="w-full rounded-lg bg-blue-600 py-3 font-semibold text-white hover:bg-blue-700">
                        Cari Tagihan
                    </button>
                </form>
            </div>

            @if ($keyword)
                <div class="mt-8">
                    @if (!$pelanggan)
                        <div class="rounded-lg bg-yellow-50 p-6 text-center shadow-md">
                            <p class="text-gray-700">Pelanggan dengan kata kunci <strong>"{{ $keyword }}"</strong>
                                tidak ditemukan.</p>
                            <p class="mt-1 text-sm text-gray-500">Pastikan nomor meteran atau nama yang dimasukkan benar.
                            </p>
                        </div>
                    @else
                        <div class="rounded-lg bg-white shadow-md">
                            <div class="rounded-t-lg bg-blue-600 p-4 text-white">
                                <h3 class="text-lg font-bold">{{ $pelanggan->nama }}</h3>
                                <p class="text-sm text-blue-100">No. Meteran: {{ $pelanggan->nomor_meteran }}</p>
                                <p class="text-sm text-blue-100">{{ $pelanggan->alamat }} - RT {{ $pelanggan->rt }}/RW
                                    {{ $pelanggan->rw }}</p>
                            </div>

                            <div class="p-6">
                                <h4 class="mb-4 font-semibold text-gray-900">Riwayat Tagihan</h4>
                                @if ($tagihan->isEmpty())
                                    <p class="text-center text-gray-500">Belum ada tagihan tercatat.</p>
                                @else
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th
                                                        class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        Periode</th>
                                                    <th
                                                        class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        Pemakaian</th>
                                                    <th
                                                        class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        Total</th>
                                                    <th
                                                        class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200 bg-white">
                                                @foreach ($tagihan as $item)
                                                    <tr>
                                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900">
                                                            {{ $namaBulan[$item->bulan] }} {{ $item->tahun }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-4 py-3 text-sm text-gray-900">
                                                            {{ number_format($item->pemakaian, 2, ',', '.') }} m³
                                                        </td>
                                                        <td
                                                            class="whitespace-nowrap px-4 py-3 text-sm font-semibold text-gray-900">
                                                            Rp {{ number_format($item->total_tagihan, 0, ',', '.') }}
                                                        </td>
                                                        <td class="whitespace-nowrap px-4 py-3">
                                                            @if ($item->status === 'sudah_bayar')
                                                                <span
                                                                    class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">
                                                                    Lunas
                                                                </span>
                                                            @else
                                                                <span
                                                                    class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">
                                                                    Belum Bayar
                                                                </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection
