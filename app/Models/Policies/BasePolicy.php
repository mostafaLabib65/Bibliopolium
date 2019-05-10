<?php

namespace App\Models\Policies;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class BasePolicy
{
    use HandlesAuthorization;
    protected $model = null;

    /**
     * BasePolicy constructor.
     */


    public function index(User $user, $args = [])
    {

        return $user->hasPermissionTo("$this->model.browse", "admin")
            || $user->hasPermissionTo("$this->model.browse", "customer");
    }

    /**
     * Determine whether the user can view the book.
     *
     * @param  \App\User $user
     * @param  \App\Model $book
     * @return mixed
     */
    public function view(User $user, $args = [])
    {

        return $user->hasPermissionTo("$this->model.read", "admin")
            || $user->hasPermissionTo("$this->model.read", "customer");    }

    /**
     * Determine whether the user can create books.
     *
     * @param  \App\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo("$this->model.add", "admin")
            || $user->hasPermissionTo("$this->model.add", "customer");    }

    /**
     * Determine whether the user can update the book.
     *
     * @param  \App\User $user
     * @param  \App\Model $book
     * @return mixed
     */
    public function update(User $user, $args = [])
    {
        return $user->hasPermissionTo("$this->model.edit", "admin")
            || $user->hasPermissionTo("$this->model.edit", "customer");
    }

    /**
     * Determine whether the user can delete the book.
     *
     * @param  \App\User $user
     * @param  \App\Model $book
     * @return mixed
     */
    public function delete(User $user, $args = [])
    {
        return $user->hasPermissionTo("$this->model.delete", "admin")
            || $user->hasPermissionTo("$this->model.delete", "customer");
    }

    /**
     * Determine whether the user can restore the book.
     *
     * @param  \App\User $user
     * @param  \App\Model $book
     * @return mixed
     */
    public function restore(User $user, Model $book)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the book.
     *
     * @param  \App\User $user
     * @param  \App\Model $book
     * @return mixed
     */
    public function forceDelete(User $user, Model $book)
    {
        //
    }
}
