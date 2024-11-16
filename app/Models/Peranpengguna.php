<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peranpengguna extends Model
{
    use HasFactory;

    // public function admins() 
    // {
    //     return $this->hasMany(Admin::class, 'prioritas');
    // }
    protected $table = 'peranpenggunas';

    protected $fillable = [
        'nama', 'prioritas'
    ];

    public function get_admin(){
    	return $this->hasMany(Admin::class, 'id_peran', 'id');
    }

    public function get_dinas(){
    	return $this->hasMany(User::class, 'id_peran', 'id');
    }
}
