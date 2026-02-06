<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
    ];
}
