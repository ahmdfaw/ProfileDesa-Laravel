<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillageProfile extends Model
{
    /** @use HasFactory<\Database\Factories\VillageProfileFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [];
    }

    protected $fillable = [
        'name',
        'history',
        'vision',
        'mission',
        'geographic_location',
        'area',
        'population',
        'districts',
        'village_head',
        'address',
        'phone',
        'email',
        'logo',
    ];
}
