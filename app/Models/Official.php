<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    /** @use HasFactory<\Database\Factories\OfficialFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [];
    }

    protected $fillable = [
        'name',
        'position',
        'type',
        'photo',
        'phone',
        'email',
        'order',
    ];
}
