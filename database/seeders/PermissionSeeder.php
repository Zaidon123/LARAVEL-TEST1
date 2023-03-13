<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        $permissions = [
            //admin
            'add courses',
            'edit courses',
            'delete courses',
            //student
            'view courses',
            'add classes',
            'view classes',
            'delete classes',
            'add rate',
            'edit rate',
            'view rate',
            'delete rate',
        ];
        $roles = [
            'admin',
            'student'
        ];

        $p = [];
        foreach ($permissions as $permission) {
            $per = Permission::create(['name' => $permission]);
            $p[] = $per;
        }
        $r = [];
        foreach ($roles as $role) {
            $rol = Role::create(['name' => $role]);
            $r[] = $rol;
        }
        foreach ($r as $i => $role) {
            foreach ($p as $j => $permission) {
                if ($i == 0) {
                    $role->givePermissionTo($permission);
                }
                if ($i == 1 && $j >= 3) {
                    $role->givePermissionTo($permission);
                }
            }
        }

        $user1 = new User();
        $user1->name = 'zaidon';
        $user1->uniqueId = Str::random(20);
        $user1->email = 'zaidon@gmail.com';
        $user1->password = Hash::make('00201239');
        $user1->phone = '0991234561';
        $user1->address = 'swaida';
        $user1->about = 'admin';
        $user1->save();
                $roleName1 = Role::findByName('admin');
                $user1->assignRole($roleName1);

    }

}
