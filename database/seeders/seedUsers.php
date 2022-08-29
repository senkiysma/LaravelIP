<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class seedUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123321'),
            'role'=>1
        ]);

        DB::table('users')->insert([
            'name' => 'M1',
            'email' => 'm1@gmail.com',
            'password' => Hash::make('memmem'),
            'role'=>2
        ]);

        DB::table('users')->insert([
            'name' => 'M2',
            'email' => 'm2@gmail.com',
            'password' => Hash::make('mommem'),
            'role'=>2
        ]);
    }
}
