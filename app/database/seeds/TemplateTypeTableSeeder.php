<?php

use Illuminate\Database\Seeder;

class TemplateTypeTableSeeder extends Seeder
{
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('templatetype')->truncate();

        $templatetype = [
            /*[
                'name' => 'Calendar',
            ],
            [
                'name' => 'Canvas',
            ],
            [
                'name' => 'Greeting Card',
            ],*/
            [
                'name' => 'Photobook',
            ],
            [
                'name' => 'Poster',
            ],
            

        ];

        // Uncomment the below to run the seeder
         DB::table('template_types')->insert($templatetype);
    }
}
