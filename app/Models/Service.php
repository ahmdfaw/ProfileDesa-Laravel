<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [];
    }

    protected $fillable = [
        'name',
        'description',
        'icon',
        'requirements',
        'procedure',
        'processing_time',
        'cost',
        'order',
    ];
}
