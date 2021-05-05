<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'check_in',
        'check_out',
    ];

    protected $table = 'monitoring';

    public $timestamps = false;

    public function scopeCurrent($query, $val) {
        return $query->where('client_id', '=', $val)
        ->where('check_out', '=', null)
        ->orderBy('check_in', 'DESC')
        ->first();
    }
}
