<?php

namespace App\Models;


use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;
    use HasRoles;

    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    protected $table = 'employee';

    protected $guard_name = 'web';

    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }

    public function scopeSearch($query, $val) {
        return $query->where('name', 'like', '%'.$val.'%')
        ->orwhere('username', 'like', '%'.$val.'%');
    }
}
