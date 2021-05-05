<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'address',
        'contact_number',
        'birthday',
        'active'
    ];

    protected $table = 'client';

    protected $hidden = [
        'password',
    ];

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function scopeActive($query) {
        return $query->where('active', '=', true)->count();
    }

    public function scopeSearch($query, $val) {
        return $query->where('first_name', 'like', '%'.$val.'%')
        ->orwhere('last_name', 'like', '%'.$val.'%')
        ->orwhere('username', 'like', '%'.$val.'%')
        ->orwhere('email', 'like', '%'.$val.'%')
        ->whereHas('plan', function($query) use ($val) {
            $query->where('is_expired', false)->take(1);
        });
    }

    public function plan() {
        return $this->belongsToMany(Plan::class, 'client_has_plans')->withPivot('id', 'remaining_time', 'time_consumed', 'end_date', 'is_expired')
            ->where('is_expired', '=', false);
    }

    public function monitoring() {
        return $this->hasMany(Monitoring::class);
    }
}
