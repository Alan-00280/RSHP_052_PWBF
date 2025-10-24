<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    protected $guarded = ['idrole'];

    public function RoleUser() {
        return $this->hasMany(RoleUser::class, 'idrole');
    }
}
