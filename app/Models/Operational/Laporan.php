<?php

namespace App\Models\Operational;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    // Nama tabel
    public $table = 'laporan';

    // Untuk format date yyyy-mm-dd hh:mm:ss
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Kolom tabel yang boleh diisi
    protected $fillable = [
        'dosen_id',
        'kelas_id',
        'agenda',
        'deskripsi',
        'tindakan',
        'slug',
        'lampiran',
        'status_dosen',
        'status_kaprodi',
        'status_kajur',
        'status_wadir',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'created_at'
            ]
        ];
    }

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
}
