<?php

namespace App\Models\MasterData;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    // Nama tabel
    public $table = 'kelas';

    // Untuk format date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Kolom tabel yang boleh diisi
    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];

    // Relasi one to many
    public function mahasiswa()
    {
        return $this->hasMany('App\Models\Operational\Mahasiswa', 'kelas_id');
    }

    // Relasi one to many
    public function laporan()
    {
        return $this->hasMany('App\Models\Operational\Laporan', 'kelas_id');
    }

    // Relasi one to many
    public function chat()
    {
        return $this->hasMany('App\Models\Operational\Chat', 'kelas_id');
    }
}
