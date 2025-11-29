<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    protected $guarded = ['idreservasi_dokter'];
    public $timestamps = false;

    public function Pet() {
        return $this->belongsTo(Pet::class, 'idpet');
    }

    public function Resepsionis() {
        return $this->belongsTo(RoleUser::class, 'iddokter');
    }

    public function RekamMedis() {
        return $this->hasOne(RekamMedis::class, 'idreservasi_dokter');
    }
}
