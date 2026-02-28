<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PamTagihan extends Model
{
    use HasFactory;

    protected $table = 'pam_tagihan';

    protected $fillable = [
        'pelanggan_id',
        'bulan',
        'tahun',
        'angka_awal',
        'angka_akhir',
        'pemakaian',
        'tarif_saat_catat',
        'total_tagihan',
        'status',
        'tanggal_bayar',
        'keterangan',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'angka_awal' => 'decimal:2',
            'angka_akhir' => 'decimal:2',
            'pemakaian' => 'decimal:2',
            'tarif_saat_catat' => 'decimal:2',
            'total_tagihan' => 'decimal:2',
            'tanggal_bayar' => 'date',
        ];
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(PamPelanggan::class, 'pelanggan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function keuangan(): HasOne
    {
        return $this->hasOne(PamKeuangan::class, 'tagihan_id');
    }

    /** @return array<string, string> */
    public static function namaBulan(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }
}
