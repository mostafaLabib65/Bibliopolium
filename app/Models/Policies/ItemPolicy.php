<?php

namespace App\Models\Policies;


use App\User;

class ItemPolicy extends BasePolicy
{
    protected $model = 'item';

    public function view(User $user, $args = [])
    {

        if ($user->hasPermissionTo('item.read', 'admin')) {
            return true;
        }
        return $user->activeCarts()
            ->with(['item' => function ($query) use ($args) {
                return $query->where('book_id', $args->book_id)
                    ->where('edition', $args->edition);
            }])
            ->get()->isNotEmpty();
    }

    public function delete(User $user, $args = [])
    {
        if ($user->hasPermissionTo('item.delete', 'admin')) {
            return true;
        }

        return $user->activeCarts()
            ->with(['item' => function ($query) use ($args) {
                return $query->where('book_id', $args->book_id)
                    ->where('edition', $args->edition);
            }])
            ->get()->isNotEmpty();
    }

}
