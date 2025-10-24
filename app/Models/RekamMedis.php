<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    protected $guarded = ['idrekam_medis'];

    public function TemuDokter() {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter');
    }

    public function RoleUser() {
        return $this->belongsTo(RoleUser::class, 'dokter_pemeriksa');
    }

    public function DetailRekamMedis(){
        return $this->hasOne(DetailRekamMedis::class, 'idrekam_medis');
    }
}
