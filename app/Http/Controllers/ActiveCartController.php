<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateActiveCartRequest;
use App\Http\Requests\UpdateActiveCartRequest;
use App\Models\ActiveCart;
use App\Models\Item;
use App\Repositories\ActiveCartRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Database\QueryException;
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
        $activeCarts = static::modelsFromRawResults($activeCarts, ActiveCart::class);
        return view('active_carts.index')
            ->with('activeCarts', $activeCarts);
    }

    public function check($id, Request $request)
    {
        $activeCart = \DB::select(
            "SELECT active_carts.*, SUM((books.price * items.quantity ))  as total_price, concat( u.last_name,', ' , u.first_name) as user_name 
                    from active_carts
                                inner join users u on active_carts.user_id = u.id
                                left join items on active_carts.id = items.cart_id
                                left join books on books.id = items.book_id
                    where active_carts.id = 2
                    GROUP BY active_carts.id
"
        )[0];
        $activeCart = static::modelFromRawResult($activeCart, $this->activeCartRepository->model());

        $items = \DB::select(
            "SELECT items.*,books.title as book_name,books.price as price, books.price * items.quantity as total_price 
                    from items inner join books on books.id = items.book_id 
                    where cart_id = $id"
        );

        $items = static::modelsFromRawResults($items, Item::class);
        return view('active_carts.checkout')
            ->with('activeCart', $activeCart)
            ->with('items', $items);
    }

    public function checkout(Request $request)
    {
        $id = $request->user()->id;
        try {
            \DB::select("CALL checkout_cart( $id , $request->credit_card )");
        } catch (QueryException $e) {
            Flash::error("Invalid Credit Card Number");
            return redirect()->back();
        }

        Flash::success(
            "Pleasure doing business with you!"
        );
        return redirect(route("bookEditions.index"));

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
//        $activeCart = $this->activeCartRepository->find($id);

        $activeCart = \DB::select(
            "SELECT active_carts.*, SUM((books.price * items.quantity ))  as total_price, concat( u.last_name,', ' , u.first_name) as user_name 
                    from active_carts
                                inner join users u on active_carts.user_id = u.id
                                left join items on active_carts.id = items.cart_id
                                left join books on books.id = items.book_id
                    where active_carts.id = $id
                    GROUP BY active_carts.id
"
        )[0];
        $activeCart = static::modelFromRawResult($activeCart, $this->activeCartRepository->model());

        $items = \DB::select(
            "SELECT items.*,books.title as book_name,books.price as price, books.price * items.quantity as total_price 
                    from items inner join books on books.id = items.book_id 
                    where cart_id = $id"
        );

        $items = static::modelsFromRawResults($items, Item::class);

        if (empty($activeCart)) {
            Flash::error('Active Cart not found');

            return redirect(route('activeCarts.index'));
        }

        return view('active_carts.show')->with('activeCart', $activeCart)
            ->withItems($items);
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
