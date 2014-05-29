<?php

class BindingMethodTableSeeder extends Seeder
{
    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('bindingmethod')->truncate();

        $bindingmethod = [
            [
                'name' => 'Hard',
            ],
            [
                'name' => 'Soft',
            ],
            [
                'name' => 'Wire-O',
            ]
        ];

        // Uncomment the below to run the seeder
         DB::table('binding_methods')->insert($bindingmethod);
    }
}
