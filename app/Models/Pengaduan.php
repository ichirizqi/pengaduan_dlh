<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduans';
    public $timestamps = false;


    protected $fillable = [
        'kode_lacak', 'tanggal_selesai', 'tanggal_mulai'
    ];

    public function get_isu(){
        return $this->belongsTo(Isu::class, 'id_isu', 'id');
    }

    public function get_aktivitas(){
    	return $this->hasMany(Aktivitas::class, 'id_pengaduan', 'id');
    }
}
