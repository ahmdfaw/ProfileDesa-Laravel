<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PamKeuangan extends Model
{
    use HasFactory;

    protected $table = 'pam_keuangan';

    protected $fillable = [
        'tanggal',
        'jenis',
        'kategori',
        'keterangan',
        'jumlah',
        'tagihan_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah' => 'decimal:2',
        ];
    }

    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(PamTagihan::class, 'tagihan_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
