<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';
    protected $guarded = ['idkategori'];

    public function KodeTindakanTerapi() {
        return $this->hasMany(KodeTindakanTerapi::class, 'idkategori');
    }
    
}
