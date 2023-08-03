<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->role()->sync(1);
        User::findOrFail(2)->role()->sync(2);
        User::findOrFail(3)->role()->sync(3);
        User::findOrFail(4)->role()->sync(4);
        User::findOrFail(5)->role()->sync(5);
        User::findOrFail(6)->role()->sync(5);
        User::findOrFail(7)->role()->sync(5);
        User::findOrFail(8)->role()->sync(5);
        User::findOrFail(9)->role()->sync(6);
        User::findOrFail(10)->role()->sync(6);
    }
}
