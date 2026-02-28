<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PamKeuangan;
use App\Models\PamPelanggan;
use App\Models\PamTagihan;
use App\Models\VillageProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PamTagihanController extends Controller
{
    public function index(Request $request): View
    {
        $query = PamTagihan::query()->with('pelanggan');

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $tagihan = $query->orderByDesc('tahun')->orderByDesc('bulan')->paginate(15)->withQueryString();
        $namaBulan = PamTagihan::namaBulan();

        return view('admin.pam.tagihan.index', compact('tagihan', 'namaBulan'));
    }

    public function create(): View
    {
        $pelanggan = PamPelanggan::where('status', 'aktif')->orderBy('nomor_meteran')->get();
        $namaBulan = PamTagihan::namaBulan();

        return view('admin.pam.tagihan.create', compact('pelanggan', 'namaBulan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pelanggan_id' => ['required', 'exists:pam_pelanggan,id'],
            'bulan' => ['required', 'integer', 'between:1,12'],
            'tahun' => ['required', 'integer', 'min:2000', 'max:2100'],
            'angka_awal' => ['required', 'numeric', 'min:0'],
            'angka_akhir' => ['required', 'numeric', 'gte:angka_awal'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'angka_akhir.gte' => 'Angka akhir tidak boleh kurang dari angka awal.',
        ]);

        $pelanggan = PamPelanggan::findOrFail($validated['pelanggan_id']);
        $pemakaian = $validated['angka_akhir'] - $validated['angka_awal'];
        $tarif = $pelanggan->tarif_per_m3;

        PamTagihan::create([
            ...$validated,
            'pemakaian' => $pemakaian,
            'tarif_saat_catat' => $tarif,
            'total_tagihan' => $pemakaian * $tarif,
            'status' => 'belum_bayar',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.pam.tagihan.index')
            ->with('success', 'Tagihan berhasil dicatat!');
    }

    public function show(PamTagihan $pamTagihan): View
    {
        $pamTagihan->load(['pelanggan', 'user', 'keuangan']);
        $namaBulan = PamTagihan::namaBulan();

        return view('admin.pam.tagihan.show', compact('pamTagihan', 'namaBulan'));
    }

    public function edit(PamTagihan $pamTagihan): View
    {
        $pelanggan = PamPelanggan::where('status', 'aktif')->orderBy('nomor_meteran')->get();
        $namaBulan = PamTagihan::namaBulan();

        return view('admin.pam.tagihan.edit', compact('pamTagihan', 'pelanggan', 'namaBulan'));
    }

    public function update(Request $request, PamTagihan $pamTagihan): RedirectResponse
    {
        $validated = $request->validate([
            'angka_awal' => ['required', 'numeric', 'min:0'],
            'angka_akhir' => ['required', 'numeric', 'gte:angka_awal'],
            'keterangan' => ['nullable', 'string'],
        ], [
            'angka_akhir.gte' => 'Angka akhir tidak boleh kurang dari angka awal.',
        ]);

        $pemakaian = $validated['angka_akhir'] - $validated['angka_awal'];
        $pamTagihan->update([
            ...$validated,
            'pemakaian' => $pemakaian,
            'total_tagihan' => $pemakaian * $pamTagihan->tarif_saat_catat,
        ]);

        return redirect()->route('admin.pam.tagihan.index')
            ->with('success', 'Tagihan berhasil diperbarui!');
    }

    public function destroy(PamTagihan $pamTagihan): RedirectResponse
    {
        $pamTagihan->delete();

        return redirect()->route('admin.pam.tagihan.index')
            ->with('success', 'Tagihan berhasil dihapus!');
    }

    public function tandaiLunas(PamTagihan $pamTagihan): RedirectResponse
    {
        if ($pamTagihan->status === 'sudah_bayar') {
            return redirect()->route('admin.pam.tagihan.index')
                ->with('error', 'Tagihan ini sudah ditandai lunas.');
        }

        $pamTagihan->update([
            'status' => 'sudah_bayar',
            'tanggal_bayar' => now()->toDateString(),
        ]);

        $namaBulan = PamTagihan::namaBulan();
        $keterangan = 'Pembayaran tagihan air '.$namaBulan[$pamTagihan->bulan].' '.$pamTagihan->tahun
            .' - '.$pamTagihan->pelanggan->nama.' ('.$pamTagihan->pelanggan->nomor_meteran.')';

        PamKeuangan::create([
            'tanggal' => now()->toDateString(),
            'jenis' => 'pemasukan',
            'kategori' => 'Pembayaran Pelanggan',
            'keterangan' => $keterangan,
            'jumlah' => $pamTagihan->total_tagihan,
            'tagihan_id' => $pamTagihan->id,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.pam.tagihan.index')
            ->with('success', 'Tagihan berhasil ditandai lunas dan dicatat ke keuangan!');
    }

    public function cetak(PamTagihan $pamTagihan): View
    {
        $pamTagihan->load(['pelanggan', 'user']);
        $namaBulan = PamTagihan::namaBulan();
        $profile = VillageProfile::first();

        return view('admin.pam.tagihan.cetak', compact('pamTagihan', 'namaBulan', 'profile'));
    }
}
