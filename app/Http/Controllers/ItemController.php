<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Repositories\ItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class ItemController extends AppBaseController
{
    /** @var  ItemRepository */
    private $itemRepository;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    /**
     * Display a listing of the Item.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $id = \Auth::user()->id;

        $items = \DB::select("select items.*, b.title as book_name, b.price as price, b.price * items.quantity as total_price from items 
          inner join book_editions be on items.book_id = be.book_id and items.edition = be.edition
          inner join books b on be.book_id = b.id 
          inner join active_carts on items.cart_id = active_carts.id 
          where active_carts.user_id = $id"
            . ($request->has('cart_id') ? " and cart_id = $request->get('cart_id')" : ""));

        $items = static::modelsFromRawResults($items, $this->itemRepository->model());

        return view('items.index')
            ->with('items', $items);
    }

    /**
     * Show the form for creating a new Item.
     *
     * @return Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created Item in storage.
     *
     * @param CreateItemRequest $request
     *
     * @return Response
     */
    public function store(CreateItemRequest $request)
    {
        $input = $request->all();

        $id = \Auth::user()->id;
        $item = \DB::insert("CALL add_item ( $id, $request->book_id, $request->edition, $request->quantity )");
        Flash::success('Item saved successfully.');

        return redirect(route('items.index'));
    }

    /**
     * Display the specified Item.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($cart, $edition, $book)
    {
        $item = static::modelFromRawResult($this->itemRepository->find_item($cart, $edition, $book), $this->itemRepository->model());


        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

        return view('items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified Item.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($cart, $edition, $book)
    {
        $item = static::modelFromRawResult($this->itemRepository->find_item($cart, $edition, $book), $this->itemRepository->model());

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

        return view('items.edit')->with('item', $item);
    }

    /**
     * Update the specified Item in storage.
     *
     * @param int $id
     * @param UpdateItemRequest $request
     *
     * @return Response
     */
    public function update($cart, $edition, $book, UpdateItemRequest $request)
    {
        $item = static::modelFromRawResult($this->itemRepository->find_item($cart, $edition, $book), $this->itemRepository->model());

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

//        $item = $this->itemRepository->update($request->all(), $id);

        Flash::success('Item updated successfully.');

        return redirect(route('items.index'));
    }

    /**
     * Remove the specified Item from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($cart, $edition, $book)
    {
        $item = static::modelFromRawResult($this->itemRepository->find_item($cart, $edition, $book), $this->itemRepository->model());

        if (empty($item)) {
            Flash::error('Item not found');

            return redirect(route('items.index'));
        }

//        $this->itemRepository->delete($id);
        $user_id = \Auth::user()->id;
        \DB::delete("CALL  remove_item( $user_id , $book, $edition) ");
//        \DB::delete("DELETE FROM items where cart_id =$cart and edition = $edition and book_id = $book");
        Flash::success('Item deleted successfully.');

        return redirect(route('items.index'));
    }
}
