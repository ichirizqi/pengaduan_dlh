<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isu extends Model
{
    use HasFactory;

    protected $table = 'isus';

    protected $fillable = [
        'nama', 'email', 'nohp', 'pihak_terduga', 'masalah', 'penyelesaian', 'foto', 'status'
    ];

    public function get_pengaduan(){
    	return $this->hasOne(Pengaduan::class, 'id_isu', 'id');
    }

}
