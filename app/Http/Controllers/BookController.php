<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Repositories\BookRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class BookController extends AppBaseController
{
    /** @var  BookRepository */
    private $bookRepository;

    public function __construct(BookRepository $bookRepo)
    {
        $this->bookRepository = $bookRepo;
    }

    /**
     * Display a listing of the Book.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', Book::class);

        $params = static::extractParams($request,
            [
                'title',
                'author',
                ['price_low' , 0],
                ['price_high' , 50000],
                ['no_of_copies_low',  0],
                'publisher',
                'isbn',
                'category'
            ],"''"
            );
        $books = \DB::select("CALL search_books(" .$params.")");

        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Book::class);
        $publishers = $publishers->pluck("name", 'id');

        $authors = \DB::select("select name, id from authors");
        $authors = static::modelsFromRawResults($authors, Author::class);
        $authors = $authors->pluck("name", 'id');

        $books = static::modelsFromRawResults($books,$this->bookRepository->model());

        return view('books.index')
            ->with('books', $books)
            ->with('params',$request)
            ->with('authors', $authors)
            ->with('publishers', $publishers);
    }

    /**
     * Show the form for creating a new Book.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Book::class);

        $authors = \DB::select("select name, id from authors");
        $authors = static::modelsFromRawResults($authors, Author::class);
        $authors = $authors->pluck("name", 'id');

        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Book::class);
        $publishers = $publishers->pluck("name", 'id');
        return view('books.create')
            ->with('authors', $authors)
            ->with('publishers', $publishers);

    }

    /**
     * Store a newly created Book in storage.
     *
     * @param CreateBookRequest $request
     *
     * @return Response
     */
    public function store(CreateBookRequest $request)
    {
        $this->authorize('create', Book::class);

        $input = $request->all();
        $book = \DB::select("Call add_new_book('" . $input['title'] . "'," . $input['authors'][0] . "," . $input['price'] . ",'" . $input['category'] . "'," . $input['threshold'] . "," . $input['no_of_copies'] . "," . $input['publisher_id'] . "," . $input['publishing_year'] . "," . $input['edition'] . "," . $input['isbn'] . ")");

        $authors = $request['authors'];
        $authors = array_slice($authors, 0);

        $book  =$book[0]->book_id;
        foreach ($authors as $author){
            \DB::select("CALL add_new_book_author( $book , $author )");
        }
        Flash::success('Book saved successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified Book.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $this->authorize('view', $this->bookRepository->find($id));

        $book = \DB::select("CALL get_book('". $id."')")[0];
        $book = static::modelFromRawResult($book,Book::class);

        $authors = \DB::select("CALL get_book_authors(".$id.")");
        $authors = static::modelsFromRawResults($authors, Author::class);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.show')
            ->with('book', $book)
            ->with('authors', $authors);
    }

    /**
     * Show the form for editing the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update', $this->bookRepository->find($id));

        $book = \DB::select("CALL get_book('". $id."')");
        $book = static::modelFromRawResult($book[0],Book::class);
        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Book::class);
        $publishers = $publishers->pluck("name", 'id');
        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.edit')
            ->with('book', $book)
            ->with('publishers', $publishers);
    }

    /**
     * Update the specified Book in storage.
     *
     * @param int $id
     * @param UpdateBookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookRequest $request)
    {
        $this->authorize('update', $this->bookRepository->find($id));

        $book = \DB::select("CALL get_book('". $id."')");
        $book = static::modelFromRawResult($book[0],Book::class);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }
        $input = $request->all();

        $book = \DB::select("CALL update_book(".$book->id.",'".$input['title']."',".$input['price'].",'".$input['category']."',".$input['threshold'].")");

        Flash::success('Book updated successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Remove the specified Book from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->bookRepository->find($id));

        $book = \DB::select("CALL get_book('". $id."')");
        $book = static::modelFromRawResult($book[0],Book::class);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        \DB::select("CALL delete_book('". $id."')");

        Flash::success('Book deleted successfully.');

        return redirect(route('books.index'));
    }
}
