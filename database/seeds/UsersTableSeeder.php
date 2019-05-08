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
        $user = App\User::create([
            "email" => "admin@admin.com",
            "password" => bcrypt("admin"),
            "username" => "admin"
        ]);

        $role = App\Models\Role::create([
            "name" => 'admin',
            'role_credential_id' => 1,
        ]);

        $user->assignRole($role);
    }
}
