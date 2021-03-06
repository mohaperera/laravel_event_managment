<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->call('TemplatesTableSeeder');
        $this->call('TemplateTypeTableSeeder');
        $this->call('BindingMethodTableSeeder');
        $this->call('CoverTypeTableSeeder');
        $this->call('GroupTableSeeder');
    }
}
