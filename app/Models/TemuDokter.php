<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemuDokter extends Model
{
    protected $table = 'temu_dokter';
    protected $primaryKey = 'idreservasi_dokter';
    protected $guarded = ['idreservasi_dokter'];

    public function Pet() {
        return $this->belongsTo(Pet::class, 'idpet');
    }

    public function RoleUser() {
        return $this->belongsTo(RoleUser::class, 'iddokter');
    }
}
