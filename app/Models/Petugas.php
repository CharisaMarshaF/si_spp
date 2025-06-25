<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Petugas extends Model
{
    use HasFactory;

    protected $table = 'petugas';

    protected $fillable = ['nama_petugas'];

// Model Petugas
public function user()
{
    return $this->hasOne(User::class, 'id_petugas'); // Relasi hasOne dengan User
}

}
