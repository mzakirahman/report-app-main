<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'           => 'Zizi Andrea',
                'email'          => 'zizi@gmail.com',
                'password'       => Hash::make('Admin12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Akmal Indra',
                'email'          => 'akmal@gmail.com',
                'password'       => Hash::make('Wadir12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Kasmawi, M.Kom',
                'email'          => 'kasmawi@gmail.com',
                'password'       => Hash::make('Kajur12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Fajri Profesio Putra, M.Cs',
                'email'          => 'fajri@gmail.com',
                'password'       => Hash::make('Kaprodi12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Fajar Ratnawati, M.Cs',
                'email'          => 'fajar@gmail.com',
                'password'       => Hash::make('Dosen12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Muhammad Asep Subandri, M.Kom',
                'email'          => 'asep@gmail.com',
                'password'       => Hash::make('Dosen12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Mansur, M.Kom',
                'email'          => 'mansur@gmail.com',
                'password'       => Hash::make('Dosen12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Jaroji, M.Kom',
                'email'          => 'jaroji@gmail.com',
                'password'       => Hash::make('Dosen12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Ramdani',
                'email'          => 'dani@gmail.com',
                'password'       => Hash::make('Mahasiswa12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'name'           => 'Febrian',
                'email'          => 'febrian@gmail.com',
                'password'       => Hash::make('Mahasiswa12345.'),
                'remember_token' => null,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        User::insert($user);
    }
}
