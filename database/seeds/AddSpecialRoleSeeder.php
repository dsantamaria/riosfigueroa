<?php

use Illuminate\Database\Seeder;
use App\Role;

class AddSpecialRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $special = Role::create([
            'name' => 'Special',
            'slug' => 'special',
            'permissions' => 'user_out_mx',
        ]);
    }
}
