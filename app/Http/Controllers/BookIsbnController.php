<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookIsbnRequest;
use App\Http\Requests\UpdateBookIsbnRequest;
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
        $bookIsbns = $this->bookIsbnRepository->all();

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
        return view('book_isbns.create');
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
        $input = $request->all();

        $bookIsbn = $this->bookIsbnRepository->create($input);

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
    public function show($id)
    {
        $bookIsbn = $this->bookIsbnRepository->find($id);

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
    public function edit($id)
    {
        $bookIsbn = $this->bookIsbnRepository->find($id);

        if (empty($bookIsbn)) {
            Flash::error('Book Isbn not found');

            return redirect(route('bookIsbns.index'));
        }

        return view('book_isbns.edit')->with('bookIsbn', $bookIsbn);
    }

    /**
     * Update the specified BookIsbn in storage.
     *
     * @param int $id
     * @param UpdateBookIsbnRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBookIsbnRequest $request)
    {
        $bookIsbn = $this->bookIsbnRepository->find($id);

        if (empty($bookIsbn)) {
            Flash::error('Book Isbn not found');

            return redirect(route('bookIsbns.index'));
        }

        $bookIsbn = $this->bookIsbnRepository->update($request->all(), $id);

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
    public function destroy($id)
    {
        $bookIsbn = $this->bookIsbnRepository->find($id);

        if (empty($bookIsbn)) {
            Flash::error('Book Isbn not found');

            return redirect(route('bookIsbns.index'));
        }

        $this->bookIsbnRepository->delete($id);

        Flash::success('Book Isbn deleted successfully.');

        return redirect(route('bookIsbns.index'));
    }
}
