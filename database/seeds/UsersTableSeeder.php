<?php

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Role;

use Webpatser\Uuid\Uuid;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $admin_user = User::create([
            'email' => 'admin@rwdp.com',
            'password' => bcrypt('Password1!'),
        ]);

        $adminRole = Role::where('name', 'Administrator')->first();
        $admin_user->roles()->attach($adminRole, ["id" => Uuid::generate()->string]);
    }
}
