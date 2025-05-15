<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengguna extends Authenticatable
{
    protected $fillable = ['nama', 'email', 'password', 'terakhir_login'];

    protected $hidden = ['password'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($pengguna) {
            if ($pengguna->password) {
                $pengguna->password = bcrypt($pengguna->password);
            }
        });

        static::updating(function ($pengguna) {
            if ($pengguna->isDirty('password')) {
                $pengguna->password = bcrypt($pengguna->password);
            }
        });
    }
}
