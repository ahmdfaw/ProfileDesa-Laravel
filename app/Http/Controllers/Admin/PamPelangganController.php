<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PamPelanggan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PamPelangganController extends Controller
{
    public function index(): View
    {
        $pelanggan = PamPelanggan::orderBy('nomor_meteran')->paginate(15);

        return view('admin.pam.pelanggan.index', compact('pelanggan'));
    }

    public function create(): View
    {
        return view('admin.pam.pelanggan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_meteran' => ['required', 'string', 'max:50', 'unique:pam_pelanggan,nomor_meteran'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'rt' => ['required', 'string', 'max:5'],
            'rw' => ['required', 'string', 'max:5'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'tarif_per_m3' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'catatan' => ['nullable', 'string'],
        ]);

        PamPelanggan::create($validated);

        return redirect()->route('admin.pam.pelanggan.index')
            ->with('success', 'Data pelanggan PAM berhasil ditambahkan!');
    }

    public function edit(PamPelanggan $pamPelanggan): View
    {
        return view('admin.pam.pelanggan.edit', compact('pamPelanggan'));
    }

    public function update(Request $request, PamPelanggan $pamPelanggan): RedirectResponse
    {
        $validated = $request->validate([
            'nomor_meteran' => ['required', 'string', 'max:50', 'unique:pam_pelanggan,nomor_meteran,'.$pamPelanggan->id],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'rt' => ['required', 'string', 'max:5'],
            'rw' => ['required', 'string', 'max:5'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'tarif_per_m3' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'catatan' => ['nullable', 'string'],
        ]);

        $pamPelanggan->update($validated);

        return redirect()->route('admin.pam.pelanggan.index')
            ->with('success', 'Data pelanggan PAM berhasil diperbarui!');
    }

    public function destroy(PamPelanggan $pamPelanggan): RedirectResponse
    {
        $pamPelanggan->delete();

        return redirect()->route('admin.pam.pelanggan.index')
            ->with('success', 'Data pelanggan PAM berhasil dihapus!');
    }
}
