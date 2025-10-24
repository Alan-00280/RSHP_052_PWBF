<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rasHewan extends Model
{
    protected $table = 'ras_hewan';
    protected $primaryKey = 'idras_hewan';
    protected $guarded = ['idras_hewan'];

    public function JenisHewan() {
        return $this->belongsTo(jenisHewan::class, 'idjenis_hewan');
    }

    public function Pet() {
        return $this->hasMany(Pet::class, 'idras_hewan');
    }
}
