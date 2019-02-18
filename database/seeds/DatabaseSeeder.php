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
     //   $this->call(UsersTableSeeder::class);
        //$this->call(RolesSeeder::class);
        //$this->call(AdminsSeeder::class);
        //$this->call(ActivateAdmin::class);
        //$this->call(AddSpecialRoleSeeder::class);
        //$this->call(RouteSeeder::class);
        $this->call(marketSeeder::class);
    }
}
