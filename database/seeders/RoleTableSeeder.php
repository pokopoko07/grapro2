<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $param = [
            'id' => 1,
            'name' => 'admin',
        ];
        DB::table('roles')->insert($param);

        $param = [
            'id' => 2,
            'name' => 'user',
        ];

        DB::table('roles')->insert($param);
    }
}
