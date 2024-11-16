<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statuspengaduan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];

    public function get_aktivitas(){
    	return $this->hasMany(Aktivitas::class, 'id_status', 'id');
    }
}
