<?php

class CoverTypeTableSeeder extends Seeder
{
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('cover_types')->truncate();

        $covertype = array(
            [
                'name' => 'Die Cut Material',
            ],
            [
                'name' => 'Image Wrap',
            ],
            [
                'name' => 'Padded Leather',
            ],
        );

        // Uncomment the below to run the seeder
         DB::table('cover_types')->insert($covertype);
    }
}
