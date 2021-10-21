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

        DB::table('pegawai')->insert([
            'pegawai_nama' => $faker->name,
            'pegawai_jabatan' => $faker->jobTitle,
            'pegawai_umur' => $faker->numberBetween(25,40),
            'pegawai_alamat' => $faker->address
        ]);
        
    }
}
