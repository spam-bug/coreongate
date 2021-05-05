<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHasPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'plan_id',
        'remaining_time',
        'time_consumed',
        'end_date',
        'is_expired',
    ];

    public function scopeCurrent($query, $val) {
        return $query->where('client_id', '=', $val)
        ->where('is_expired', '=', 'false');
    }
}
