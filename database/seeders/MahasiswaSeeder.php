<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operational\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = [
            [
                'user_id'            => 9, 
                'kelas_id'           => 14, 
                'name'               => 'Ramdani', 
                'nim'                => null, 
                'gender'             => 1, 
                'contact'            => '087723134189', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'            => 10, 
                'kelas_id'           => 15, 
                'name'               => 'Febrian', 
                'nim'                => null, 
                'gender'             => 1, 
                'contact'            => '085621859310', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ]
        ];

        Mahasiswa::insert($mahasiswa);
    }
}
