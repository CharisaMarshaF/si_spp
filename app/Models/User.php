<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    protected $table = 'user';

    protected $fillable = [
        'nisn', 'username', 'password', 'level','id_petugas'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }


// Model User
public function petugas()
{
    return $this->belongsTo(Petugas::class, 'id_petugas'); // Relasi belongsTo dengan Petugas
}

}
