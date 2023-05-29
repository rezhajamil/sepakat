<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nik' => '1111',
            'name' => 'Admin',
            'email' => 'admin@sepakat.info',
            'password' => bcrypt('medan123'),
            'role' => 'admin',
        ]);
    }
}
