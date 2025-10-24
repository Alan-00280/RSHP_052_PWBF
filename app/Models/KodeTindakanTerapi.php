<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeTindakanTerapi extends Model
{
    protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    protected $guarded = ['idkode_tindakan_terapi'];

    public function KategoriKlinis() {
        return $this->belongsTo(KategoriKlinis::class, 'idkategori_klinis');
    }

    public function Kategori() {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }
}
