<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $primaryKey = 'idrole_user';
    protected $guarded = ['idrole_user'];

    public function Role() {
        return $this->belongsTo(Role::class, 'idrole');
    }

    public function TemuDokter() {
        return $this->hasMany(TemuDokter::class, 'iddokter');
    }

    public function User() {
        return $this->belongsTo(UserRshp::class, 'iduser');
    }

    public function RekamMedis() {
        return $this->hasMany(RekamMedis::class, 'dokter_pemeriksa');
    }

    public static function RoleAktif($userId) {
        return DB::table('role_user')
            ->where('iduser', '=', $userId)
            ->where('status', '=', '1')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->get()
        ;
    }
}
