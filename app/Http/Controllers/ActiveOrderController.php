<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActiveOrderRequest;
use App\Http\Requests\UpdateActiveOrderRequest;
use App\Models\ActiveOrder;
use App\Models\Book;
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
        $activeOrders = \DB::select("CALL index_active_orders");
        $activeOrders = static::modelsFromRawResults($activeOrders,ActiveOrder::class);

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
        $books = \DB::select("CALL index_books()");
        $books = static::modelsFromRawResults($books,Book::class);
        $books = $books->pluck("title",'id');

        return view('active_orders.create')->withBooks($books);
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

        $activeOrder = \DB::select("CALL add_new_order(".$input['book_id'].", ".$input['quantity'].")");

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
        $activeOrder = \DB::select("CALL get_active_order(".$id.")")[0];
        $activeOrder = static::modelFromRawResult($activeOrder,ActiveOrder::class);

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
        $activeOrder = \DB::select("CALL get_active_order(".$id.")")[0];
        $activeOrder = static::modelFromRawResult($activeOrder,ActiveOrder::class);

        if (empty($activeOrder)) {
            Flash::error('Active Order not found');

            return redirect(route('activeOrders.index'));
        }

        return view('active_orders.confirm')->with('activeOrder', $activeOrder);
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
        $activeOrder = \DB::select("CALL get_active_order(".$id.")")[0];
        $activeOrder = static::modelFromRawResult($activeOrder,ActiveOrder::class);

        if (empty($activeOrder)) {
            Flash::error('Active Order not found');

            return redirect(route('activeOrders.index'));
        }
        $input = $request->all();

        $activeOrder = \DB::select("CALL delete_from_active_order(".$id.", '".$input['status']."')");

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

}
