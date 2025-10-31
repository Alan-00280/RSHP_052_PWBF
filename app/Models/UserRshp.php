<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRshp extends Authenticatable
{
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $guarded = ['iduser'];
    public $timestamps = false;

    protected $hidden = [
        'password'
    ];

    public function Pemilik() {
        return $this->hasOne(Pemilik::class, 'iduser');
    }

    public function RoleUser() {
        return $this->hasMany(RoleUser::class, 'iduser');
    }
}
