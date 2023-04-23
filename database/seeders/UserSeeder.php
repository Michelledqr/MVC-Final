<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Michelle',
            'email' => 'dominique.robinson@est.iudigital.edu.co',
            'password' => bcrypt('123456')
        ])->assignRole('Admin');

        User::factory(3)->create();


    }
}
