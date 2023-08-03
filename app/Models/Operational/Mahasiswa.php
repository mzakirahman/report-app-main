<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Nama tabel
    public $table = 'mahasiswa';

    // Untuk format date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Kolom tabel yang boleh diisi
    protected $fillable = [
        'user_id',
        'kelas_id',
        'name',
        'nim',
        'birth_place',
        'birth_date',
        'gender',
        'contact',
        'address',
        'photo',
        'created_at',
        'updated_at',
    ];

    // Relasi one to many
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    // Relasi one to many
    public function kelas()
    {
        return $this->belongsTo('App\Models\MasterData\Kelas', 'kelas_id', 'id');
    }
}
