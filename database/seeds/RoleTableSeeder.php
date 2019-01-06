<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->delete();
        DB::table('roles')->delete();

        $role_admin = new Role();
        $role_admin->name = 'Administrator';
        $role_admin->description = 'Administrator';
        $role_admin->save();
        
        $role_user = new Role();
        $role_user->name = 'Subscriber';
        $role_user->description = 'Subscriber';
        $role_user->save();
    }
}
