<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';
    public $timestamps = false;

    protected $fillable = [
        'id_pengaduan',
        'kode_lacak',
        'tanggal',
        'narasi',
        'id_status',
        'nama_pengadu',
        'foto'
    ];

    public function get_pengaduan(){
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id');
    }

    public function get_status(){
        return $this->belongsTo(Statuspengaduan::class, 'id_status', 'id');
    }
}
