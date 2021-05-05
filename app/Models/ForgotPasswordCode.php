<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPasswordCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'code',
        'is_expired',
    ];

    public function scopeCheck($query, $client, $code) {
        return $query->where('client_id', $client)
        ->where('code', $code)
        ->where('is_expired', false);
    }
}
