<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insert default hierarchies
        DB::table('hierarchy')->insert(['name' => 'Admin']);
        DB::table('hierarchy')->insert(['name' => 'Chofer']);
        //Insert default user
        DB::table('users')->insert([
            'name' => 'Prueba',
            'surnames' => 'jefe',
            'jobId' => 1,
            'sex' => 'M',
            'birthday' => date('Y-m-d H:i:s'),
            'curp' => 'CURP123',
            'rfc' => 'RFC123',
            'adress' => 'Su casa',
            'street' => 'Colonia',
            'phoneNumber' => '2299113452',
            'password' => Hash::make('123'),
            'profilePick' => 'profile-picks/GUatRslAQiw8l4CHtYqlkfIWJDs2s2pXc9tuL6zk.jpeg'
        ]);
        DB::table('users')->insert([
            'name' => 'chofer',
            'surnames' => 'prueba',
            'jobId' => 2,
            'sex' => 'M',
            'birthday' => date('Y-m-d H:i:s'),
            'curp' => 'CHOFER123',
            'rfc' => 'CHOFER123',
            'adress' => 'Su casa',
            'street' => 'Colonia',
            'phoneNumber' => '2299113452',
            'password' => Hash::make('123'),
            'profilePick' => 'profile-picks/GUatRslAQiw8l4CHtYqlkfIWJDs2s2pXc9tuL6zk.jpeg'
        ]);
    }
}
