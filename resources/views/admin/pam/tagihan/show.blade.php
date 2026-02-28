@extends('layouts.admin')

@section('title', 'Detail Tagihan PAM')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-gray-900">Detail Tagihan PAM</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.pam.tagihan.cetak', $pamTagihan->id) }}" target="_blank"
                class="rounded-lg bg-purple-600 px-4 py-2 text-white hover:bg-purple-700">
                Cetak Struk
            </a>
            <a href="{{ route('admin.pam.tagihan.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50">
                Kembali
            </a>
        </div>
    </div>

    <div class="rounded-lg bg-white p-6 shadow">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Informasi Pelanggan</h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nomor Meteran</dt>
                        <dd class="text-sm text-gray-900">{{ $pamTagihan->pelanggan->nomor_meteran }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nama</dt>
                        <dd class="text-sm text-gray-900">{{ $pamTagihan->pelanggan->nama }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                        <dd class="text-sm text-gray-900">{{ $pamTagihan->pelanggan->alamat }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">RT/RW</dt>
                        <dd class="text-sm text-gray-900">RT {{ $pamTagihan->pelanggan->rt }} / RW
                            {{ $pamTagihan->pelanggan->rw }}</dd>
                    </div>
                </dl>
            </div>

            <div>
                <h2 class="mb-4 text-lg font-semibold text-gray-900">Detail Tagihan</h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Periode</dt>
                        <dd class="text-sm text-gray-900">{{ $namaBulan[$pamTagihan->bulan] }} {{ $pamTagihan->tahun }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Angka Meter Awal</dt>
                        <dd class="text-sm text-gray-900">{{ number_format($pamTagihan->angka_awal, 2, ',', '.') }} m³</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Angka Meter Akhir</dt>
                        <dd class="text-sm text-gray-900">{{ number_format($pamTagihan->angka_akhir, 2, ',', '.') }} m³</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Pemakaian</dt>
                        <dd class="text-sm font-semibold text-gray-900">
                            {{ number_format($pamTagihan->pemakaian, 2, ',', '.') }} m³</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tarif per m³</dt>
                        <dd class="text-sm text-gray-900">Rp
                            {{ number_format($pamTagihan->tarif_saat_catat, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Total Tagihan</dt>
                        <dd class="text-lg font-bold text-blue-700">Rp
                            {{ number_format($pamTagihan->total_tagihan, 0, ',', '.') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status</dt>
                        <dd>
                            @if ($pamTagihan->status === 'sudah_bayar')
                                <span
                                    class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-800">Lunas</span>
                                <span class="ml-2 text-sm text-gray-500">
                                    {{ $pamTagihan->tanggal_bayar ? $pamTagihan->tanggal_bayar->format('d M Y') : '' }}
                                </span>
                            @else
                                <span class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-800">Belum
                                    Bayar</span>
                            @endif
                        </dd>
                    </div>
                    @if ($pamTagihan->keterangan)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Keterangan</dt>
                            <dd class="text-sm text-gray-900">{{ $pamTagihan->keterangan }}</dd>
                        </div>
                    @endif
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Dicatat oleh</dt>
                        <dd class="text-sm text-gray-900">{{ $pamTagihan->user->name }} -
                            {{ $pamTagihan->created_at->format('d M Y') }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        @if ($pamTagihan->status === 'belum_bayar')
            <div class="mt-6 border-t border-gray-200 pt-6">
                <form action="{{ route('admin.pam.tagihan.tandai-lunas', $pamTagihan->id) }}" method="POST"
                    onsubmit="return confirm('Tandai tagihan ini sudah lunas?')">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="rounded-lg bg-green-600 px-6 py-2 text-white hover:bg-green-700">
                        Tandai Lunas
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection
