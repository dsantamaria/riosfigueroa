<?php

use Illuminate\Database\Seeder;
use App\User;

class ActivateAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'admin@admin.com')->update(['active' => 1]);
    }
}
