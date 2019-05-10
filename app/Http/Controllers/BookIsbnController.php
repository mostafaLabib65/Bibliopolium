<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookIsbnRequest;
use App\Http\Requests\UpdateBookIsbnRequest;
use App\Models\Book;
use App\Models\BookIsbn;
use App\Repositories\BookIsbnRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BookIsbnController extends AppBaseController
{
    /** @var  BookIsbnRepository */
    private $bookIsbnRepository;

    public function __construct(BookIsbnRepository $bookIsbnRepo)
    {
        $this->bookIsbnRepository = $bookIsbnRepo;
    }

    /**
     * Display a listing of the BookIsbn.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', BookIsbn::class);

        $bookIsbns = \DB::select("CALL index_book_isbns");
        $bookIsbns = static::modelsFromRawResults($bookIsbns,BookIsbn::class);

        return view('book_isbns.index')
            ->with('bookIsbns', $bookIsbns);
    }

    /**
     * Show the form for creating a new BookIsbn.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', BookIsbn::class);

        $books = \DB::select("CALL index_books()");
        $books = static::modelsFromRawResults($books,Book::class);
        $books = $books->pluck("title",'id');

        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Book::class);
        $publishers = $publishers->pluck("name", 'id');
        return view('book_isbns.create')
            ->withBooks($books)
            ->with('publishers', $publishers);;
    }

    /**
     * Store a newly created BookIsbn in storage.
     *
     * @param CreateBookIsbnRequest $request
     *
     * @return Response
     */
    public function store(CreateBookIsbnRequest $request)
    {
        $this->authorize('create', BookIsbn::class);

        $input = $request->all();

        $bookIsbn = \DB::select("CALL add_new_isbn(".$input['book_id'].",".$input['publisher_id'].",".$input['isbn'].")");

        Flash::success('Book Isbn saved successfully.');

        return redirect(route('bookIsbns.index'));
    }

    /**
     * Display the specified BookIsbn.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($book_id, $publisher_id)
    {

        $bookIsbn = \DB::select("CALL get_isbn(".$book_id.",".$publisher_id.")")[0];
        $bookIsbn = static::modelFromRawResult($bookIsbn,BookIsbn::class);
        $this->authorize('view', $bookIsbn);

        if (empty($bookIsbn)) {
            Flash::error('Book Isbn not found');

            return redirect(route('bookIsbns.index'));
        }

        return view('book_isbns.show')->with('bookIsbn', $bookIsbn);
    }

    /**
     * Show the form for editing the specified BookIsbn.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($book_id, $publisher_id)
    {

        $bookIsbn = \DB::select("CALL get_isbn(".$book_id.",".$publisher_id.")")[0];
        $bookIsbn = static::modelFromRawResult($bookIsbn,BookIsbn::class);
        $this->authorize('update', $bookIsbn);

        $books = \DB::select("CALL index_books()");
        $books = static::modelsFromRawResults($books,Book::class);
        $books = $books->pluck("title",'id');

        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Book::class);
        $publishers = $publishers->pluck("name", 'id');
        if (empty($bookIsbn)) {
            Flash::error('Book Isbn not found');

            return redirect(route('bookIsbns.index'));
        }

        return view('book_isbns.edit')
            ->with('bookIsbn', $bookIsbn)
            ->with('books', $books)
            ->with('publishers', $publishers);;
    }

    /**
     * Update the specified BookIsbn in storage.
     *
     * @param int $id
     * @param UpdateBookIsbnRequest $request
     *
     * @return Response
     */
    public function update($book_id, $publisher_id,UpdateBookIsbnRequest $request)
    {

        $bookIsbn = \DB::select("CALL get_isbn(".$book_id.",".$publisher_id.")")[0];
        $bookIsbn = static::modelFromRawResult($bookIsbn,BookIsbn::class);
        $this->authorize('update', $bookIsbn);

        if (empty($bookIsbn)) {
            Flash::error('Book Isbn not found');

            return redirect(route('bookIsbns.index'));
        }
        $input = $request->all();

        $bookIsbn = \DB::select("CALL update_isbn(".$book_id.", ".$publisher_id.", ".$input['isbn'].")");

        Flash::success('Book Isbn updated successfully.');

        return redirect(route('bookIsbns.index'));
    }

    /**
     * Remove the specified BookIsbn from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($book_id, $publisher_id)
    {

        $bookIsbn = \DB::select("CALL get_isbn(".$book_id.",".$publisher_id.")")[0];
        $bookIsbn = static::modelFromRawResult($bookIsbn,BookIsbn::class);
        $this->authorize('delete', $bookIsbn);

        if (empty($bookIsbn)) {
            Flash::error('Book Isbn not found');

            return redirect(route('bookIsbns.index'));
        }

        \DB::select("CALL delete_isbn(".$book_id.", ".$publisher_id.")");

        Flash::success('Book Isbn deleted successfully.');

        return redirect(route('bookIsbns.index'));
    }
}
