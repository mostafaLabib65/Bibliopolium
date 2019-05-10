<?php

namespace App\Models\Policies;



use App\User;

class ActiveCartPolicy extends BasePolicy
{
    protected $model = 'active_cart';

    public function view(User $user, $args = [])
    {

        if($user->hasPermissionTo('active_cart.read','admin')){
            return true;
        }
        return $user->activeCarts->first()->id == $args->id;
    }

    public function delete(User $user, $args = [])
    {
        if($user->hasPermissionTo('active_cart.delete','admin')){
            return true;
        }
        return $user->activeCarts->first()->id == $args->id;
    }


}
