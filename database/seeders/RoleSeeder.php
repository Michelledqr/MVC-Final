<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'super-admin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'User']);

        Permission::create(['name' => 'programas.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'programas.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'programas.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'programas.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'profesors.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'profesors.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'profesors.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'profesors.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'materias.index'])->syncRoles([$role1]);
        Permission::create(['name' => 'materias.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'materias.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'materias.destroy'])->syncRoles([$role1]);

        Permission::create(['name' => 'contenidos.index'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'contenidos.create'])->syncRoles([$role1]);
        Permission::create(['name' => 'contenidos.edit'])->syncRoles([$role1]);
        Permission::create(['name' => 'contenidos.destroy'])->syncRoles([$role1]);



    }
}
