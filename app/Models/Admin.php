<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    // public function peran(){
    // 	return $this->belongsTo(Peranpengguna::class, 'prioritas');
    // }
    protected $table = 'admins';


    protected $fillable = [
        'name',
        'email',
        'password',
        'foto'
    ];

    public function get_peran(){
        return $this->belongsTo(Peranpengguna::class, 'id_peran', 'id');
    }
}
