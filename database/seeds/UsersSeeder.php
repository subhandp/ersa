<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'username' => '419322',
                'account_year' => '2021'
            ],
            [
                'name' => 'petugas',
                'email' => 'petugas@gmail.com',
                'role' => 'petugas',
                'username' => '419333',
                'account_year' => '2021'
            ]
        ]);
        
    }
}
