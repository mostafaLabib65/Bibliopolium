<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHistoryOrderRequest;
use App\Http\Requests\UpdateHistoryOrderRequest;
use App\Models\HistoryOrder;
use App\Repositories\HistoryOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class HistoryOrderController extends AppBaseController
{
    /** @var  HistoryOrderRepository */
    private $historyOrderRepository;

    public function __construct(HistoryOrderRepository $historyOrderRepo)
    {
        $this->historyOrderRepository = $historyOrderRepo;
    }

    /**
     * Display a listing of the HistoryOrder.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', HistoryOrder::class);

        $historyOrders = \DB::select("CALL index_history_orders");
        $historyOrders = static::modelsFromRawResults($historyOrders,HistoryOrder::class);

        return view('history_orders.index')
            ->with('historyOrders', $historyOrders);
    }

    /**
     * Show the form for creating a new HistoryOrder.
     *
     * @return Response
     */
//    public function create()
//    {
//        //not allowed to create !!
//        return view('history_orders.create');
//    }
//
//    /**
//     * Store a newly created HistoryOrder in storage.
//     *
//     * @param CreateHistoryOrderRequest $request
//     *
//     * @return Response
//     */
//    public function store(CreateHistoryOrderRequest $request)
//    {
//        $input = $request->all();
//
//        $historyOrder = $this->historyOrderRepository->create($input);
//
//        Flash::success('History Order saved successfully.');
//
//        return redirect(route('historyOrders.index'));
//    }

    /**
     * Display the specified HistoryOrder.
     *
     * @param int $id
     *
     * @return Response
     */
//    public function show($id)
//    {
//        $historyOrder = $this->historyOrderRepository->find($id);
//
//        if (empty($historyOrder)) {
//            Flash::error('History Order not found');
//
//            return redirect(route('historyOrders.index'));
//        }
//
//        return view('history_orders.show')->with('historyOrder', $historyOrder);
//    }

    /**
     * Show the form for editing the specified HistoryOrder.
     *
     * @param int $id
     *
     * @return Response
     */
//    public function edit($id)
//    {
//        $historyOrder = $this->historyOrderRepository->find($id);
//
//        if (empty($historyOrder)) {
//            Flash::error('History Order not found');
//
//            return redirect(route('historyOrders.index'));
//        }
//
//        return view('history_orders.edit')->with('historyOrder', $historyOrder);
//    }
//
//    /**
//     * Update the specified HistoryOrder in storage.
//     *
//     * @param int $id
//     * @param UpdateHistoryOrderRequest $request
//     *
//     * @return Response
//     */
//    public function update($id, UpdateHistoryOrderRequest $request)
//    {
//        $historyOrder = $this->historyOrderRepository->find($id);
//
//        if (empty($historyOrder)) {
//            Flash::error('History Order not found');
//
//            return redirect(route('historyOrders.index'));
//        }
//
//        $historyOrder = $this->historyOrderRepository->update($request->all(), $id);
//
//        Flash::success('History Order updated successfully.');
//
//        return redirect(route('historyOrders.index'));
//    }

    /**
     * Remove the specified HistoryOrder from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
//    public function destroy($id)
//    {
//        $historyOrder = $this->historyOrderRepository->find($id);
//
//        if (empty($historyOrder)) {
//            Flash::error('History Order not found');
//
//            return redirect(route('historyOrders.index'));
//        }
//
//        $this->historyOrderRepository->delete($id);
//
//        Flash::success('History Order deleted successfully.');
//
//        return redirect(route('historyOrders.index'));
//    }
}
