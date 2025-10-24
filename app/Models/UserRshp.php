<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRshp extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $guarded = ['iduser'];

    public function Pemilik() {
        return $this->hasOne(Pemilik::class, 'iduser');
    }

    public function RoleUser() {
        return $this->hasMany(RoleUser::class, 'iduser');
    }
}
