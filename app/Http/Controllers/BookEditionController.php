<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookEditionRequest;
use App\Http\Requests\UpdateBookEditionRequest;
use App\Models\Book;
use App\Models\BookEdition;
use App\Repositories\BookEditionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BookEditionController extends AppBaseController
{
    /** @var  BookEditionRepository */
    private $bookEditionRepository;

    public function __construct(BookEditionRepository $bookEditionRepo)
    {
        $this->bookEditionRepository = $bookEditionRepo;
    }

    /**
     * Display a listing of the BookEdition.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', BookEdition::class);

        $bookEditions =\DB::select("CALL index_book_editions");
        $bookEditions = static::modelsFromRawResults($bookEditions, BookEdition::class);

        return view('book_editions.index')
            ->with('bookEditions', $bookEditions);
    }

    /**
     * Show the form for creating a new BookEdition.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', BookEdition::class);

        $books = \DB::select("CALL index_books()");
        $books = static::modelsFromRawResults($books,Book::class);
        $books = $books->pluck("title",'id');

        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Book::class);
        $publishers = $publishers->pluck("name", 'id');
        return view('book_editions.create')
            ->withBooks($books)
            ->with('publishers', $publishers);
    }

    /**
     * Store a newly created BookEdition in storage.
     *
     * @param CreateBookEditionRequest $request
     *
     * @return Response
     */
    public function store(CreateBookEditionRequest $request)
    {
        $this->authorize('create', BookEdition::class);

        $input = $request->all();

        $bookEdition = \DB::select("CALL add_new_edition(".$input['book_id'].",".$input['publisher_id'].",".$input['publishing_year'].",".$input['no_of_copies'].",".$input['edition'].")");

        Flash::success('Book Edition saved successfully.');

        return redirect(route('bookEditions.index'));
    }

    /**
     * Display the specified BookEdition.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($book, $edition)
    {

        $bookEdition = \DB::select("CALL get_book_edition(".$book.",".$edition.")")[0];

        $bookEdition = static::modelFromRawResult($bookEdition,BookEdition::class);

        $this->authorize('view', $bookEdition);


        if (empty($bookEdition)) {
            Flash::error('Book Edition not found');

            return redirect(route('bookEditions.index'));
        }

        return view('book_editions.show')->with('bookEdition', $bookEdition);
    }

    /**
     * Show the form for editing the specified BookEdition.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id, $edition)
    {

        $bookEdition = \DB::select("CALL get_book_edition(".$id.",".$edition.")")[0];

        $bookEdition = static::modelFromRawResult($bookEdition,BookEdition::class);
        $this->authorize('update', $bookEdition);

        $books = \DB::select("CALL index_books()");
        $books = static::modelsFromRawResults($books,Book::class);
        $books = $books->pluck("title",'id');

        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Book::class);
        $publishers = $publishers->pluck("name", 'id');

        if (empty($bookEdition)) {
            Flash::error('Book Edition not found');

            return redirect(route('bookEditions.index'));
        }

        return view('book_editions.edit')
            ->with('bookEdition', $bookEdition)
            ->with('books', $books)
            ->with('publishers', $publishers);
    }

    /**
     * Update the specified BookEdition in storage.
     *
     * @param int $id
     * @param UpdateBookEditionRequest $request
     *
     * @return Response
     */
    public function update($id, $edition,UpdateBookEditionRequest $request)
    {

        $bookEdition = \DB::select("CALL get_book_edition(".$id.",".$edition.")")[0];

        $bookEdition = static::modelFromRawResult($bookEdition,BookEdition::class);

        $this->authorize('update', $bookEdition);

        if (empty($bookEdition)) {
            Flash::error('Book Edition not found');

            return redirect(route('bookEditions.index'));
        }

        $input = $request->all();

        $bookEdition = \DB::select("CALL update_book_edition(".$id.",".$edition.",".$input['edition'].",".$input['publisher_id'].",".$input['publishing_year'].",".$input['no_of_copies'].")");

        Flash::success('Book Edition updated successfully.');

        return redirect(route('bookEditions.index'));
    }

    /**
     * Remove the specified BookEdition from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, $edition)
    {
      //  $this->authorize('delete', $this->bookEditionRepository->find($id, $edition));

        $bookEdition = \DB::select("CALL get_book_edition(".$id.",".$edition.")")[0];

        $bookEdition = static::modelFromRawResult($bookEdition,BookEdition::class);

        $this->authorize('delete', $bookEdition);

        if (empty($bookEdition)) {
            Flash::error('Book Edition not found');

            return redirect(route('bookEditions.index'));
        }

        \DB::select("CALL delete_book_edition('". $id."', '".$edition."')");

        Flash::success('Book Edition deleted successfully.');

        return redirect(route('bookEditions.index'));
    }
}
