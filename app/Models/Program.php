<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /** @use HasFactory<\Database\Factories\ProgramFactory> */
    use HasFactory;

    protected $table = 'programs';

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
