<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActiveOrderRequest;
use App\Http\Requests\UpdateActiveOrderRequest;
use App\Repositories\ActiveOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ActiveOrderController extends AppBaseController
{
    /** @var  ActiveOrderRepository */
    private $activeOrderRepository;

    public function __construct(ActiveOrderRepository $activeOrderRepo)
    {
        $this->activeOrderRepository = $activeOrderRepo;
    }

    /**
     * Display a listing of the ActiveOrder.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $activeOrders = $this->activeOrderRepository->all();

        return view('active_orders.index')
            ->with('activeOrders', $activeOrders);
    }

    /**
     * Show the form for creating a new ActiveOrder.
     *
     * @return Response
     */
    public function create()
    {
        return view('active_orders.create');
    }

    /**
     * Store a newly created ActiveOrder in storage.
     *
     * @param CreateActiveOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateActiveOrderRequest $request)
    {
        $input = $request->all();

        $activeOrder = $this->activeOrderRepository->create($input);

        Flash::success('Active Order saved successfully.');

        return redirect(route('activeOrders.index'));
    }

    /**
     * Display the specified ActiveOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activeOrder = $this->activeOrderRepository->find($id);

        if (empty($activeOrder)) {
            Flash::error('Active Order not found');

            return redirect(route('activeOrders.index'));
        }

        return view('active_orders.show')->with('activeOrder', $activeOrder);
    }

    /**
     * Show the form for editing the specified ActiveOrder.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activeOrder = $this->activeOrderRepository->find($id);

        if (empty($activeOrder)) {
            Flash::error('Active Order not found');

            return redirect(route('activeOrders.index'));
        }

        return view('active_orders.edit')->with('activeOrder', $activeOrder);
    }

    /**
     * Update the specified ActiveOrder in storage.
     *
     * @param int $id
     * @param UpdateActiveOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateActiveOrderRequest $request)
    {
        $activeOrder = $this->activeOrderRepository->find($id);

        if (empty($activeOrder)) {
            Flash::error('Active Order not found');

            return redirect(route('activeOrders.index'));
        }

        $activeOrder = $this->activeOrderRepository->update($request->all(), $id);

        Flash::success('Active Order updated successfully.');

        return redirect(route('activeOrders.index'));
    }

    /**
     * Remove the specified ActiveOrder from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activeOrder = $this->activeOrderRepository->find($id);

        if (empty($activeOrder)) {
            Flash::error('Active Order not found');

            return redirect(route('activeOrders.index'));
        }

        $this->activeOrderRepository->delete($id);

        Flash::success('Active Order deleted successfully.');

        return redirect(route('activeOrders.index'));
    }
}
