<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    // Nama tabel
    public $table = 'dosen';

    // Untuk format date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Kolom tabel yang boleh diisi
    protected $fillable = [
        'user_id',
        'position_id',
        'name',
        'nik_nip',
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
    public function position()
    {
        return $this->belongsTo('App\Models\MasterData\Position', 'position_id', 'id');
    }

    // Relasi one to many
    public function laporan()
    {
        return $this->hasMany('App\Models\Operational\Laporan', 'dosen_id');
    }

    // Relasi one to many
    public function chat()
    {
        return $this->hasMany('App\Models\Operational\Chat', 'dosen_id');
    }
}
