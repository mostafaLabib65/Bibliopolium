<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorBookRequest;
use App\Http\Requests\UpdateAuthorBookRequest;
use App\Models\Author;
use App\Models\AuthorBook;
use App\Repositories\AuthorBookRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AuthorBookController extends AppBaseController
{
    /** @var  AuthorBookRepository */
    private $authorBookRepository;

    public function __construct(AuthorBookRepository $authorBookRepo)
    {
        $this->authorBookRepository = $authorBookRepo;
    }

    /**
     * Display a listing of the AuthorBook.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', AuthorBook::class);

        $authorBooks = \DB::select("CALL index_book_authors");
        static::modelsFromRawResults($authorBooks, AuthorBook::class);

        return view('author_books.index')
            ->with('authorBooks', $authorBooks);
    }

    /**
     * Show the form for creating a new AuthorBook.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', AuthorBook::class);

        return view('author_books.create');
    }

    /**
     * Store a newly created AuthorBook in storage.
     *
     * @param CreateAuthorBookRequest $request
     *
     * @return Response
     */
    public function store(CreateAuthorBookRequest $request)
    {
        $this->authorize('create', AuthorBook::class);

        $input = $request->all();

        $authorBook = \DB::select("CALL add_new_book_author(".$input['book_id'].", ".$input['author_id'].")");

        Flash::success('Author Book saved successfully.');

        return redirect(route('authorBooks.index'));
    }

    /**
     * Display the specified AuthorBook.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($book_id, $author_id)
    {

        $authorBook = \DB::select("CALL get_book_author(".$book_id.",".$author_id.")")[0];
        $authorBook = static::modelFromRawResult($authorBook,AuthorBook::class);
        $this->authorize('view', $authorBook);


        if (empty($authorBook)) {
            Flash::error('Author Book not found');

            return redirect(route('authorBooks.index'));
        }

        return view('author_books.show')->with('authorBook', $authorBook);
    }

    /**
     * Show the form for editing the specified AuthorBook.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($book_id, $author_id)
    {
        $authorBook = \DB::select("CALL get_book_author(".$book_id.",".$author_id.")")[0];
        $authorBook = static::modelFromRawResult($authorBook,AuthorBook::class);
        $this->authorize('update', $authorBook);


        if (empty($authorBook)) {
            Flash::error('Author Book not found');

            return redirect(route('authorBooks.index'));
        }

        return view('author_books.edit')->with('authorBook', $authorBook);
    }

    /**
     * Update the specified AuthorBook in storage.
     *
     * @param int $id
     * @param UpdateAuthorBookRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuthorBookRequest $request)
    {
        $authorBook = $this->authorBookRepository->find($id);
        $this->authorize('update', $authorBook);

        if (empty($authorBook)) {
            Flash::error('Author Book not found');

            return redirect(route('authorBooks.index'));
        }

        $authorBook = $this->authorBookRepository->update($request->all(), $id);

        Flash::success('Author Book updated successfully.');

        return redirect(route('authorBooks.index'));
    }

    /**
     * Remove the specified AuthorBook from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($book_id, $author_id)
    {

        $authorBook = \DB::select("CALL get_book_author(".$book_id.",".$author_id.")")[0];
        $authorBook = static::modelFromRawResult($authorBook,AuthorBook::class);
        $this->authorize('delete', $authorBook);

        if (empty($authorBook)) {
            Flash::error('Author Book not found');

            return redirect(route('authorBooks.index'));
        }

        \DB::select("CALL delete_author_book(".$book_id.", ".$author_id.")");

        Flash::success('Author Book deleted successfully.');

        return redirect(route('authorBooks.index'));
    }
}
