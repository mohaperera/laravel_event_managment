<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');
       // DB::table('groups')->truncate();

        $notices = [
            ['title' => 'Admin', 'description' => 'Admin', 'created_at' => $now, 'updated_at' => $now],
            ['title' => 'Manager', 'description' => 'Manager', 'created_at' => $now, 'updated_at' => $now],       
        ];
        DB::table('groups')->insert($notices);
    }

}
