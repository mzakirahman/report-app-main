<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operational\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = [
            [
                'user_id'            => 2, 
                'position_id'        => 2, 
                'name'               => 'Akmal Indra', 
                'nik_nip'            => null, 
                'gender'             => 1, 
                'contact'            => '082211223344', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'            => 3, 
                'position_id'        => 3, 
                'name'               => 'Kasmawi, M.Kom', 
                'nik_nip'            => null, 
                'gender'             => 1, 
                'contact'            => '082233554193', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'            => 4, 
                'position_id'        => 4, 
                'name'               => 'Fajri Profesio Putra, M.Cs', 
                'nik_nip'            => null, 
                'gender'             => 1, 
                'contact'            => '082298643576', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'            => 5, 
                'position_id'        => 5, 
                'name'               => 'Fajar Ratnawati, M.Cs', 
                'nik_nip'            => null, 
                'gender'             => 1, 
                'contact'            => '082134128179', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'            => 6, 
                'position_id'        => 5, 
                'name'               => 'Muhammad Asep Subandri, M.Kom', 
                'nik_nip'            => null, 
                'gender'             => 2, 
                'contact'            => '081174381230', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'            => 7, 
                'position_id'        => 5, 
                'name'               => 'Mansur, M.Kom', 
                'nik_nip'            => null, 
                'gender'             => 1, 
                'contact'            => '082385419412', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'            => 8, 
                'position_id'        => 5, 
                'name'               => 'Jaroji, M.Kom', 
                'nik_nip'            => null, 
                'gender'             => 1, 
                'contact'            => '085234718319', 
                'address'            => 'Bengkalis', 
                'photo'              => null, 
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s'),
            ],
        ];

        Dosen::insert($dosen);
    }
}
