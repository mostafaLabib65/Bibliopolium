<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create credentials
        $root_cred = \App\Models\RoleCredential::create(
            [
                "role_name" => "root",
                "user_name" => "root",
                "decrypted_password" => "password"
            ]
        );

        $manager_cred = \App\Models\RoleCredential::create(
            [
                "role_name" => "manager",
                "user_name" => "root",
                "decrypted_password" => "password"
            ]
        );

        $customer_cred = \App\Models\RoleCredential::create(
            [
                "role_name" => "customer",
                "user_name" => "root",
                "decrypted_password" => "password"
            ]
        );

        $guest = \App\Models\RoleCredential::create(
            [
                "role_name" => "guest",
                "user_name" => "root",
                "decrypted_password" => "password"
            ]
        );
        //create roles
        $admin = Role::create(["name" => "admin", "guard_name" => "admin", "role_credential_id" => $root_cred['id']]);
        $manager = Role::create(["name" => "manager", "guard_name" => "admin","role_credential_id"=> $manager_cred['id']]);
        $customer = Role::create(["name" => "customer", "guard_name" => "customer", "role_credential_id"=>$customer_cred['id']]);


        //create permissions

        $models = [
            'active_cart', 'active_order', 'author', 'book', 'book_edition', 'book_isbn',
            'history_order', 'item', 'publisher',
            'purchase_history', 'role', 'statistic'
        ];

        $bread = ['browse', 'read', 'edit', 'add', 'delete'];


        $permissions = [];

        foreach ($models as $model) {
            foreach ($bread as $crumb) {
                $permissions[$model][$crumb]['admin'] = \Spatie\Permission\Models\Permission::create(["name" => "$model.$crumb" ,"guard_name"=>"admin"]);
                $permissions[$model][$crumb]['customer'] = \Spatie\Permission\Models\Permission::create(["name" => "$model.$crumb" ,"guard_name"=>"customer"]);
            }
        }


        // assign permissions
        $admin->givePermissionTo(Permission::all()->where('guard_name','admin'));

        $manager->givePermissionTo(Permission::all()->where('guard_name','admin'));

        $customer_permissions = [
            'active_cart' => ['read','delete'],
            'author' => ['browse','read'],
            'book' => ['browse','read'],
            'book_edition' => ['browse','read'],
            'book_isbn' => ['browse','read'],
            'item' => ['read','add','delete'],
        ];

        foreach ($customer_permissions as $key=>$value){
            foreach ($value as $actions){
                $customer->givePermissionTo($permissions[$key][$actions]['customer']);
            }
        }

    }
}
