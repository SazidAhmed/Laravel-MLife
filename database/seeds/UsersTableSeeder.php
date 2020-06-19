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
        DB::table('users')->insert([
            'role_id'   => '1',
            'name'      =>'Admin',
            'username'  =>'admin',
            'email'     =>'admin@gmail.com',
            'password'  => bcrypt('123456789'),
        ]);

        DB::table('users')->insert([
            'role_id'   => '2',
            'name'      =>'User',
            'username'  =>'user',
            'email'     =>'user@gmail.com',
            'password'  => bcrypt('123456789'),
        ]);

    }
}
