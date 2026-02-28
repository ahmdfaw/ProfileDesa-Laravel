<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PamKeuangan;
use App\Models\PamTagihan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PamKeuanganController extends Controller
{
    public function index(Request $request): View
    {
        $query = PamKeuangan::query()->with(['tagihan.pelanggan', 'user']);

        if ($request->filled('jenis')) {
            $query->where('jenis', $request->jenis);
        }

        if ($request->filled('bulan') && $request->filled('tahun')) {
            $query->whereMonth('tanggal', $request->bulan)
                ->whereYear('tanggal', $request->tahun);
        } elseif ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        $transaksi = $query->orderByDesc('tanggal')->paginate(15)->withQueryString();

        $totalPemasukan = $query->clone()->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $query->clone()->where('jenis', 'pengeluaran')->sum('jumlah');

        $namaBulan = PamTagihan::namaBulan();

        return view('admin.pam.keuangan.index', compact(
            'transaksi',
            'totalPemasukan',
            'totalPengeluaran',
            'namaBulan'
        ));
    }

    public function create(): View
    {
        $namaBulan = PamTagihan::namaBulan();

        return view('admin.pam.keuangan.create', compact('namaBulan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'jenis' => ['required', 'in:pemasukan,pengeluaran'],
            'kategori' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string'],
            'jumlah' => ['required', 'numeric', 'min:0'],
        ]);

        PamKeuangan::create([
            ...$validated,
            'tagihan_id' => null,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.pam.keuangan.index')
            ->with('success', 'Transaksi keuangan PAM berhasil dicatat!');
    }

    public function edit(PamKeuangan $pamKeuangan): View
    {
        return view('admin.pam.keuangan.edit', compact('pamKeuangan'));
    }

    public function update(Request $request, PamKeuangan $pamKeuangan): RedirectResponse
    {
        $validated = $request->validate([
            'tanggal' => ['required', 'date'],
            'jenis' => ['required', 'in:pemasukan,pengeluaran'],
            'kategori' => ['required', 'string', 'max:255'],
            'keterangan' => ['required', 'string'],
            'jumlah' => ['required', 'numeric', 'min:0'],
        ]);

        $pamKeuangan->update($validated);

        return redirect()->route('admin.pam.keuangan.index')
            ->with('success', 'Transaksi keuangan PAM berhasil diperbarui!');
    }

    public function destroy(PamKeuangan $pamKeuangan): RedirectResponse
    {
        $pamKeuangan->delete();

        return redirect()->route('admin.pam.keuangan.index')
            ->with('success', 'Transaksi keuangan PAM berhasil dihapus!');
    }
}
