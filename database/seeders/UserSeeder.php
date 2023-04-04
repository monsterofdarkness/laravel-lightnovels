<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 1
            ],
            [
                'name' => 'Shinokawa',
                'email' => 'shinokawa@gmail.com',
                'password' => Hash::make('123456789'),
                'role' => 1
            ],
    );
    }
}
