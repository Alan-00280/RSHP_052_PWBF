<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perawat extends Model
{
    protected $table = 'perawat';
    protected $primaryKey = 'id_perawat';
    protected $guarded = ['id_perawat', 'id_user'];
    public $timestamps = false;

    public function UserRshp() {
        return $this->belongsTo(UserRshp::class, 'id_user');
    }
}
