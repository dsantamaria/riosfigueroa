<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
        	'name' => 'super administrador',
            'email' => 'super@super.com',
            'password' => bcrypt('123456'),
        ]);
        $new_super_admin = Role::where('slug', 'super_admin')->pluck('id');
        $super_admin->roles()->attach($new_super_admin[0]);

        $admin = User::create([
        	'name' => 'administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
        $new_admin = Role::where('slug', 'admin')->pluck('id');
        $admin->roles()->attach($new_admin[0]);
    }
}
