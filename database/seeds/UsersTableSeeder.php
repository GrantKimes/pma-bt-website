<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Brothers',
        	'email' => 'grantkimes@gmail.com',
        	'password' => bcrypt('BT1937')
        ]);
    }
}
