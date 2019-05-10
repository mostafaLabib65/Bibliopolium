<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;
use App\Models\Publisher;
use App\Repositories\PublisherRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PublisherController extends AppBaseController
{
    /** @var  PublisherRepository */
    private $publisherRepository;

    public function __construct(PublisherRepository $publisherRepo)
    {
        $this->publisherRepository = $publisherRepo;
    }

    /**
     * Display a listing of the Publisher.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', Publisher::class);

        $publishers = \DB::select("CALL index_publishers");
        $publishers = static::modelsFromRawResults($publishers,Publisher::class);

        return view('publishers.index')
            ->with('publishers', $publishers);
    }

    /**
     * Show the form for creating a new Publisher.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Publisher::class);

        return view('publishers.create');
    }

    /**
     * Store a newly created Publisher in storage.
     *
     * @param CreatePublisherRequest $request
     *
     * @return Response
     */
    public function store(CreatePublisherRequest $request)
    {
        $this->authorize('create', Publisher::class);

        $input = $request->all();



        $publisher = \DB::select("CALL add_new_publisher('". $input['name']." ',' " .$input['address']. " ','  " .$input['phone_number']. " ')");

        Flash::success('Publisher saved successfully.');

        return redirect(route('publishers.index'));
    }

    /**
     * Display the specified Publisher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $this->authorize('view', $this->publisherRepository->find($id));

        $publisher = \DB::select("CALL get_publisher('". $id."')");
        $publisher = static::modelFromRawResult($publisher[0],Publisher::class);

        if (empty($publisher)) {
            Flash::error('Publisher not found');

            return redirect(route('publishers.index'));
        }

        return view('publishers.show')->with('publisher', $publisher);
    }

    /**
     * Show the form for editing the specified Publisher.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->authorize('update', $this->publisherRepository->find($id));

        $publisher = \DB::select("CALL get_publisher('". $id."')");
        $publisher = static::modelFromRawResult($publisher[0],Publisher::class);

        if (empty($publisher)) {
            Flash::error('Publisher not found');

            return redirect(route('publishers.index'));
        }

        return view('publishers.edit')->with('publisher', $publisher);
    }

    /**
     * Update the specified Publisher in storage.
     *
     * @param int $id
     * @param UpdatePublisherRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePublisherRequest $request)
    {
        $this->authorize('update', $this->publisherRepository->find($id));

        $publisher = \DB::select("CALL get_publisher('". $id."')");
        $publisher = static::modelFromRawResult($publisher[0],Publisher::class);

        if (empty($publisher)) {
            Flash::error('Publisher not found');

            return redirect(route('publishers.index'));
        }

        $input = $request->all();

        $publisher = \DB::select("CALL update_publisher('". $publisher->id." ',' " .$input['name']. " ','  " .$input['address']. " ',' " .$input['phone_number']. " ')");


        Flash::success('Publisher updated successfully.');

        return redirect(route('publishers.index'));
    }

    /**
     * Remove the specified Publisher from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->publisherRepository->find($id));

        $publisher = \DB::select("CALL get_publisher('". $id."')");
        $publisher = static::modelFromRawResult($publisher[0],Publisher::class);

        if (empty($publisher)) {
            Flash::error('Publisher not found');

            return redirect(route('publishers.index'));
        }

        \DB::select("CALL delete_publisher('". $id."')");

        Flash::success('Publisher deleted successfully.');

        return redirect(route('publishers.index'));
    }
}