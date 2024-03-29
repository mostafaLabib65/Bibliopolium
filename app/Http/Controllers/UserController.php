<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Http\Request;
use Flash;
use Response;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }


    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = \DB::select("Select users.*,r.name as role from users left join model_has_roles on model_id=users.id left join roles r on model_has_roles.role_id = r.id where model_type='App\\\\User'");
        $users = static::modelsFromRawResults($users, $this->userRepository->model());

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $request['password'] = bcrypt($request['password']);
        $params = static::extractParams($request,
            [
                'user_name',
                'email',
                'first_name',
                'last_name',
                'shipping_address',
                'phone_number',
                'password',
                'role'
            ]);

        $user = \DB::select("CALL CREATE_USER(" . $params . ")");

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = \DB::select("Select users.*,roles.name as role from users left join model_has_roles on model_id = users.id and model_type = 'App\\\\User' left join roles on model_has_roles.role_id  = roles.id where users.id = $id");
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $user = static::modelFromRawResult($user[0], $this->userRepository->model());
        return view('users.show')->with('user', $user)->withRole($user->role);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = \DB::select("SELECT * from users where id = $id");

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $user = static::modelFromRawResult($user[0], User::class);
        $roles = Role::all()->pluck('name', 'id');
        $role = $user->roles->first()->id;
        return view('users.edit')->with('user', $user)->withRoles($roles)->withRole($role);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {

        $request['password'] = $request->has('password') && $request['password'] != null ? bcrypt($request['password']) : null;
        $request['id'] = $id;

        $user = \DB::select("Select * from users where id = $id");

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $params = static::extractParams($request,
            [
                'id',
                'user_name',
                'email',
                'first_name',
                'last_name',
                'shipping_address',
                'phone_number',
                'password',
                'role'
            ]);
        \DB::select("CALL UPDATE_USER(" . $params . ")");

        $user = static::modelFromRawResult($user[0], User::class);
        $user->roles()->sync($request['role']);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = \DB::select("Select * from users where id = $id");

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        \DB::delete("Delete from users where id  = $id");

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
