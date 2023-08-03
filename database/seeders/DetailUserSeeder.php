<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ManagementAccess\DetailUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_user = [
            [
                'user_id'        => 1,
                'type_user_id'   => 1,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 2,
                'type_user_id'   => 2,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 3,
                'type_user_id'   => 2,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 4,
                'type_user_id'   => 2,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 5,
                'type_user_id'   => 2,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 6,
                'type_user_id'   => 2,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 7,
                'type_user_id'   => 2,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 8,
                'type_user_id'   => 2,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 9,
                'type_user_id'   => 3,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
            [
                'user_id'        => 10,
                'type_user_id'   => 3,
                'gender'         => NULL,
                'contact'        => NULL,
                'address'        => NULL,
                'photo'          => NULL,
                'created_at'     => date('Y-m-d H:i:s'),
                'updated_at'     => date('Y-m-d H:i:s'),
            ],
        ];

        DetailUser::insert($detail_user);
    }
}
