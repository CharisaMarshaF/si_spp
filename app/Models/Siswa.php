<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{

    protected $primaryKey = 'nisn';
    public $incrementing = false; 
    protected $keyType = 'string'; 
    protected $table = 'siswa';  

    protected $fillable = ['nisn', 'nis', 'nama', 'id_kelas', 'id_spp', 'alamat', 'no_telp'];


    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp');
    }


    public function user()
    {
        return $this->hasOne(User::class, 'nisn', 'nisn');
    }
}