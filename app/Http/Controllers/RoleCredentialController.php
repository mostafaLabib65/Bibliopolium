<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleCredentialRequest;
use App\Http\Requests\UpdateRoleCredentialRequest;
use App\Repositories\RoleCredentialRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class RoleCredentialController extends AppBaseController
{
    /** @var  RoleCredentialRepository */
    private $roleCredentialRepository;

    public function __construct(RoleCredentialRepository $roleCredentialRepo)
    {
        $this->roleCredentialRepository = $roleCredentialRepo;
    }

    /**
     * Display a listing of the RoleCredential.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roleCredentials = $this->roleCredentialRepository->all();

        return view('role_credentials.index')
            ->with('roleCredentials', $roleCredentials);
    }

    /**
     * Show the form for creating a new RoleCredential.
     *
     * @return Response
     */
    public function create()
    {
        return view('role_credentials.create');
    }

    /**
     * Store a newly created RoleCredential in storage.
     *
     * @param CreateRoleCredentialRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleCredentialRequest $request)
    {
        $input = $request->all();

        $roleCredential = $this->roleCredentialRepository->create($input);

        Flash::success('Role Credential saved successfully.');

        return redirect(route('roleCredentials.index'));
    }

    /**
     * Display the specified RoleCredential.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $roleCredential = $this->roleCredentialRepository->find($id);

        if (empty($roleCredential)) {
            Flash::error('Role Credential not found');

            return redirect(route('roleCredentials.index'));
        }

        return view('role_credentials.show')->with('roleCredential', $roleCredential);
    }

    /**
     * Show the form for editing the specified RoleCredential.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $roleCredential = $this->roleCredentialRepository->find($id);

        if (empty($roleCredential)) {
            Flash::error('Role Credential not found');

            return redirect(route('roleCredentials.index'));
        }

        return view('role_credentials.edit')->with('roleCredential', $roleCredential);
    }

    /**
     * Update the specified RoleCredential in storage.
     *
     * @param int $id
     * @param UpdateRoleCredentialRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleCredentialRequest $request)
    {
        $roleCredential = $this->roleCredentialRepository->find($id);

        if (empty($roleCredential)) {
            Flash::error('Role Credential not found');

            return redirect(route('roleCredentials.index'));
        }

        $roleCredential = $this->roleCredentialRepository->update($request->all(), $id);

        Flash::success('Role Credential updated successfully.');

        return redirect(route('roleCredentials.index'));
    }

    /**
     * Remove the specified RoleCredential from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $roleCredential = $this->roleCredentialRepository->find($id);

        if (empty($roleCredential)) {
            Flash::error('Role Credential not found');

            return redirect(route('roleCredentials.index'));
        }

        $this->roleCredentialRepository->delete($id);

        Flash::success('Role Credential deleted successfully.');

        return redirect(route('roleCredentials.index'));
    }
}
