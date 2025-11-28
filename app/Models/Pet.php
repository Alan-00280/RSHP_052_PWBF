<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    protected $guarded = ['idpet'];

    public $timestamps = false;

    public function RasHewan() {
        return $this->belongsTo(rasHewan::class, 'idras_hewan');
    }

    public function Pemilik() {
        return $this->belongsTo(Pemilik::class, 'idpemilik');
    }

    public function TemuDokter() {
        return $this->hasOne(TemuDokter::class, 'idreservasi_dokter');
    }

}
