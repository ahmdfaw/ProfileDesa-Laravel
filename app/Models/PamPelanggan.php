<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PamPelanggan extends Model
{
    use HasFactory;

    protected $table = 'pam_pelanggan';

    protected $fillable = [
        'nomor_meteran',
        'nama',
        'alamat',
        'rt',
        'rw',
        'no_hp',
        'tarif_per_m3',
        'status',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tarif_per_m3' => 'decimal:2',
        ];
    }

    public function tagihan(): HasMany
    {
        return $this->hasMany(PamTagihan::class, 'pelanggan_id');
    }
}
