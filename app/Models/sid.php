<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sid extends Model
{
    use HasFactory;

    protected $fillable = [
        'originating',
        'terminating',
        'service',
        'register',
        'bulan',
        'tahun',
        'status'
    ];

    protected $casts = [
        'id' => 'string'
    ];
}
