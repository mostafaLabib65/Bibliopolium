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
        $params = static::extractParams($request,
            [
                'title',
                'author',
                ['price_low' , 0],
                ['price_high' , 50000],
                ['no_of_copies_low',  0],
                'publisher',
                'isbn',
                'isbn'
            ],"''"
            );
        $books = \DB::select("CALL search_books(" .$params.")");

        $books = static::modelsFromRawResults($books,$this->bookRepository->model());
//        $books = $this->bookRepository->all();

        return view('books.index')
            ->with('books', $books);
    }

    /**
     * Show the form for creating a new Book.
     *
     * @return Response
     */
    public function create()
    {
        $authors = \DB::select("select name, id from authors");
        $authors = static::modelsFromRawResults($authors, Author::class);
        return view('books.create')
            ->with('authors', $authors);
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
        $input = $request->all();

        $book = \DB::select("Call add_new_book('".$input['title']."',".$input['author_id'].",".$input['price'].",'".$input['category']."',".$input['threshold'].",".$input['no_of_copies'].",".$input['publisher_id'].",".$input['publishing_year'].",".$input['edition'].",".$input['isbn'].")");

        Flash::success('Book saved successfully.');

        return redirect(route('books.index'));
    }

    /**
     * Display the specified Book.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $book = \DB::select("CALL get_book('". $id."')");
        $book = static::modelFromRawResult($book[0],Book::class);

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
        $book = \DB::select("CALL get_book('". $id."')");
        $book = static::modelFromRawResult($book[0],Book::class);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }

        return view('books.edit')->with('book', $book);
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
        $book = \DB::select("CALL get_book('". $id."')");
        $book = static::modelFromRawResult($book[0],Book::class);

        if (empty($book)) {
            Flash::error('Book not found');

            return redirect(route('books.index'));
        }
        $input = $request->all();

        $book = \DB::select("CALL update_book(".$book->id.",'".$input['title']."',".$input['price'].",'".$input['category']."',".$input['threshold'].",".$input['no_of_copies'].")");

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
