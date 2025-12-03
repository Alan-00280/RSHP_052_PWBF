<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    protected $guarded = ['id_dokter', 'id_user'];
    public $timestamps = false;

    public function UserRshp() {
        return $this->belongsTo(UserRshp::class, 'id_user');
    }
    
}
