<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'time',
        'unlimited_time',
        'expiration',
        'no_expiration',
    ];

    public function scopeSearch($query, $val) {
        return $query->where('name', 'like', '%'.$val.'%');
    }
}
