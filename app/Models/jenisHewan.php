<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jenisHewan extends Model
{
    protected $table = 'jenis_hewan';

    protected $guarded = ['idjenis_hewan'];

    protected $primaryKey = 'idjenis_hewan';

    public function DetailRekamMedis() {
        return $this->hasMany(rasHewan::class, 'idjenis_hewan');
    }
}
