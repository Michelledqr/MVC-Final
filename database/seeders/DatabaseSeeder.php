<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\BasicAdminPermissionSeeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Programa::factory(4)->create();
        \App\Models\Materia::factory(10)->create();
        \App\Models\Profesor::factory(7)->create();
        \App\Models\Contenido::factory(10)->create();


        //$this->call (RoleSeeder::class);
    
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    
        /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    
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





        User::create([
            'name' => 'Michelle',
            'email' => 'dominique.robinson@est.iudigital.edu.co',
            'password' => bcrypt('123456')
        ])->assignRole($role1);


        User::create([
            'name' => 'Admin User',
            'email' => 'admin@est.iudigital.edu.co',
            'password' => bcrypt('123456')
        ])->assignRole($role2);
        

        $user = \App\Models\User::factory()->create([
            'name' => 'Student User',
            'email' => 'student01@est.iudigital.edu.co',
            'password' => bcrypt('123456')
        ])->assignRole($role3);
        



        User::factory(3)->create();






    }
}
