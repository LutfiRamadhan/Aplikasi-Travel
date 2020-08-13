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
        App\User::create([
            'name' => 'Lutfi Ramadhan',
            'email' => 'lutfiramadan@gmail.com',
            'password' => bcrypt('P@ssw0rd'),
            'id_karyawan' => 1
        ]);
    }
}
