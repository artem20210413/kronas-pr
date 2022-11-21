<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('action_material')->insert([
            [
                "id" => 3,
                'action_m' => "Moving"
            ],
            [
                "id" => 2,
                'action_m' => "Editing"
            ],
            [
                "id" => 1,
                'action_m' => "Creating"
            ]
        ]);
    }
}
