<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActiveCartRequest;
use App\Http\Requests\UpdateActiveCartRequest;
use App\Models\ActiveCart;
use App\Repositories\ActiveCartRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ActiveCartController extends AppBaseController
{
    /** @var  ActiveCartRepository */
    private $activeCartRepository;

    public function __construct(ActiveCartRepository $activeCartRepo)
    {
        $this->activeCartRepository = $activeCartRepo;
    }

    /**
     * Display a listing of the ActiveCart.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $activeCarts = \DB::select("CAll index_carts");
        $activeCarts = static::modelsFromRawResults($activeCarts,ActiveCart::class);
        return view('active_carts.index')
            ->with('activeCarts', $activeCarts);
    }

    /**
     * Show the form for creating a new ActiveCart.
     *
     * @return Response
     */
    public function create()
    {
        return view('active_carts.create');
    }

    /**
     * Store a newly created ActiveCart in storage.
     *
     * @param CreateActiveCartRequest $request
     *
     * @return Response
     */
    public function store(CreateActiveCartRequest $request)
    {
        $input = $request->all();

        $activeCart = $this->activeCartRepository->create($input);

        Flash::success('Active Cart saved successfully.');

        return redirect(route('activeCarts.index'));
    }

    /**
     * Display the specified ActiveCart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activeCart = $this->activeCartRepository->find($id);

        if (empty($activeCart)) {
            Flash::error('Active Cart not found');

            return redirect(route('activeCarts.index'));
        }

        return view('active_carts.show')->with('activeCart', $activeCart);
    }

    /**
     * Show the form for editing the specified ActiveCart.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activeCart = $this->activeCartRepository->find($id);

        if (empty($activeCart)) {
            Flash::error('Active Cart not found');

            return redirect(route('activeCarts.index'));
        }

        return view('active_carts.edit')->with('activeCart', $activeCart);
    }

    /**
     * Update the specified ActiveCart in storage.
     *
     * @param int $id
     * @param UpdateActiveCartRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActiveCartRequest $request)
    {
        $activeCart = $this->activeCartRepository->find($id);

        if (empty($activeCart)) {
            Flash::error('Active Cart not found');

            return redirect(route('activeCarts.index'));
        }

        $activeCart = $this->activeCartRepository->update($request->all(), $id);

        Flash::success('Active Cart updated successfully.');

        return redirect(route('activeCarts.index'));
    }

    /**
     * Remove the specified ActiveCart from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activeCart = $this->activeCartRepository->find($id);

        if (empty($activeCart)) {
            Flash::error('Active Cart not found');

            return redirect(route('activeCarts.index'));
        }

        $this->activeCartRepository->delete($id);

        Flash::success('Active Cart deleted successfully.');

        return redirect(route('activeCarts.index'));
    }
}
