<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAuthorRequest;
use App\Http\Requests\UpdateAuthorRequest;
use App\Models\Author;
use App\Repositories\AuthorRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class AuthorController extends AppBaseController
{
    /** @var  AuthorRepository */
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepo)
    {
        $this->authorRepository = $authorRepo;
    }

    /**
     * Display a listing of the Author.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', Author::class);

        $authors = \DB::select("CALL index_authors");
        $authors = static::modelsFromRawResults($authors,Author::class);

        return view('authors.index')
            ->with('authors', $authors);
    }

    /**
     * Show the form for creating a new Author.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Author::class);

        return view('authors.create');
    }

    /**
     * Store a newly created Author in storage.
     *
     * @param CreateAuthorRequest $request
     *
     * @return Response
     */
    public function store(CreateAuthorRequest $request)
    {
        $this->authorize('create', Author::class);

        $input = $request->all();

        $author = \DB::select("CALL add_new_author('".$input['name'] ."')");

        Flash::success('Author saved successfully.');

        return redirect(route('authors.index'));
    }

    /**
     * Display the specified Author.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', $this->authorRepository->find($id));

        $author = \DB::select("CALL get_author('". $id."')");
        $author = static::modelFromRawResult($author[0],Author::class);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }

        return view('authors.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified Author.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('edit', $this->authorRepository->find($id));

        $author = \DB::select("CALL get_author('". $id."')");
        $author = static::modelFromRawResult($author[0],Author::class);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }

        return view('authors.edit')->with('author', $author);
    }

    /**
     * Update the specified Author in storage.
     *
     * @param int $id
     * @param UpdateAuthorRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAuthorRequest $request)
    {
        $this->authorize('edit', $this->authorRepository->find($id));

        $author = \DB::select("CALL get_author('". $id."')");
        $author = static::modelFromRawResult($author[0],Author::class);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }
        $input = $request->all();

        $author = \DB::select("CALL update_author('".$author['id']."', '".$input['name']."')");

        Flash::success('Author updated successfully.');

        return redirect(route('authors.index'));
    }

    /**
     * Remove the specified Author from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->authorRepository->find($id));

        $author = \DB::select("CALL get_author('". $id."')");
        $author = static::modelFromRawResult($author[0],Author::class);

        if (empty($author)) {
            Flash::error('Author not found');

            return redirect(route('authors.index'));
        }

        \DB::select("CALL delete_Author('". $id."')");

        Flash::success('Author deleted successfully.');

        return redirect(route('authors.index'));
    }
}
