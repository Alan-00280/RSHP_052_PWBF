<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    protected $table = 'pemilik';
    protected $primaryKey = 'idpemilik';
    protected $guarded = ['idpemilik'];

    public function User() {
        return $this->belongsTo(UserRshp::class, 'iduser');
    }

    public function Pet() {
        return $this->hasMany(Pet::class, 'idpemilik');
    }
}
