<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    // Nama tabel
    public $table = 'chat';

    // Untuk format date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Kolom tabel yang boleh diisi
    protected $fillable = [
        'dosen_id',
        'user_id',
        'deskripsi',
        'pesan',
        'balasan',
        'status',
        'created_at',
        'updated_at',
    ];

    // Relasi one to many
    public function dosen()
    {
        return $this->belongsTo('App\Models\Operational\Dosen', 'dosen_id', 'id');
    }

    // Relasi one to many
    public function kelas()
    {
        return $this->belongsTo('App\Models\MasterData\Kelas', 'kelas_id', 'id');
    }

    // Relasi one to many
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
