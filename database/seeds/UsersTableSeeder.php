<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->truncate();

        \App\User::create([
            'name'      => 'Mahmoud Mokhtar',
            'email'     => 'mahmoud@birdsol.com',
            'password'  => bcrypt('password'),
        ]);
    }
}
