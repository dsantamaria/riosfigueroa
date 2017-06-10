<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = Role::create([
            'name' => 'Super_admin',
            'slug' => 'super_admin',
            'permissions' => 'super',
        ]);

        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => 'admin',
        ]);

        $user = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => 'default',
        ]);
    }
}
