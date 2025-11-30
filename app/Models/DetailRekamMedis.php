<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailRekamMedis extends Model
{
    protected $table = 'detail_rekam_medis';
    protected $primaryKey = 'iddetail_rekam_medis';
    protected $guarded = ['iddetail_rekam_medis'];
    public $timestamps = false;

    public function RekamMedis() {
        return $this->belongsTo(RekamMedis::class, 'idrekam_medis');
    }

    public function KodeTindakanTerapi() {
        return $this->belongsTo(KodeTindakanTerapi::class,'idkode_tindakan_terapi');
    }
}
