<?php

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionUpdate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create permissions

        $models = [
            'user','author_book'
        ];

        $bread = ['browse', 'read', 'edit', 'add', 'delete'];

//
//        $permissions = [];
//
//        foreach ($models as $model) {
//            foreach ($bread as $crumb) {
//                $permissions[$model][$crumb]['admin'] = \Spatie\Permission\Models\Permission::create(["name" => "$model.$crumb", "guard_name" => "admin"]);
//                $permissions[$model][$crumb]['customer'] = \Spatie\Permission\Models\Permission::create(["name" => "$model.$crumb", "guard_name" => "customer"]);
//            }
//        }

        // assign permissions
        $admin = Role::where(['name'=>'admin','guard_name'=>'admin'])->get()->first();
        $manager = Role::where(['name'=>'manager','guard_name'=>'admin'])->get()->first();
//        $customer = Role::where(['name'=>'customer','guard'=>'customer'])->get()->first();

        $admin->givePermissionTo(Permission::all()->where('guard_name','admin'));

        $manager->givePermissionTo(Permission::all()->where('guard_name','admin'));

//        $customer_permissions = [
//            'user' => ['read','delete'],
//            'author' => ['browse','read'],
//            'book' => ['browse','read'],
//            'book_edition' => ['browse','read'],
//            'book_isbn' => ['browse','read'],
//            'item' => ['read','add','delete'],
//        ];
//
//        foreach ($customer_permissions as $key=>$value){
//            foreach ($value as $actions){
//                $customer->givePermissionTo($permissions[$key][$actions]['customer']);
//            }
//        }
    }
}
