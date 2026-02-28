<?php

namespace App\Http\Controllers;

use App\Models\PamPelanggan;
use App\Models\PamTagihan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PamController extends Controller
{
    public function index(Request $request): View
    {
        $pelanggan = null;
        $tagihan = collect();
        $keyword = $request->input('cari');

        if ($keyword) {
            $pelanggan = PamPelanggan::query()
                ->where('status', 'aktif')
                ->where(function ($q) use ($keyword) {
                    $q->where('nomor_meteran', 'like', '%'.$keyword.'%')
                        ->orWhere('nama', 'like', '%'.$keyword.'%');
                })
                ->first();

            if ($pelanggan) {
                $tagihan = PamTagihan::query()
                    ->where('pelanggan_id', $pelanggan->id)
                    ->orderByDesc('tahun')
                    ->orderByDesc('bulan')
                    ->get();
            }
        }

        $namaBulan = PamTagihan::namaBulan();

        return view('pam.index', compact('pelanggan', 'tagihan', 'keyword', 'namaBulan'));
    }
}
