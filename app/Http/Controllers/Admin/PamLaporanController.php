<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PamKeuangan;
use App\Models\PamTagihan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PamLaporanController extends Controller
{
    public function index(Request $request): View
    {
        $bulan = $request->input('bulan', now()->month);
        $tahun = $request->input('tahun', now()->year);

        $tagihan = PamTagihan::query()
            ->with('pelanggan')
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->orderBy('status')
            ->get();

        $totalTagihan = $tagihan->count();
        $sudahBayar = $tagihan->where('status', 'sudah_bayar')->count();
        $belumBayar = $tagihan->where('status', 'belum_bayar')->count();
        $totalNominal = $tagihan->sum('total_tagihan');
        $nominalLunas = $tagihan->where('status', 'sudah_bayar')->sum('total_tagihan');
        $nominalBelumBayar = $tagihan->where('status', 'belum_bayar')->sum('total_tagihan');

        $keuangan = PamKeuangan::query()
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderByDesc('tanggal')
            ->get();

        $totalPemasukan = $keuangan->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $keuangan->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $namaBulan = PamTagihan::namaBulan();

        return view('admin.pam.laporan.index', compact(
            'bulan',
            'tahun',
            'tagihan',
            'totalTagihan',
            'sudahBayar',
            'belumBayar',
            'totalNominal',
            'nominalLunas',
            'nominalBelumBayar',
            'keuangan',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'namaBulan'
        ));
    }
}
