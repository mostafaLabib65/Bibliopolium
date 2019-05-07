<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePurchaseHistoryRequest;
use App\Http\Requests\UpdatePurchaseHistoryRequest;
use App\Repositories\PurchaseHistoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class PurchaseHistoryController extends AppBaseController
{
    /** @var  PurchaseHistoryRepository */
    private $purchaseHistoryRepository;

    public function __construct(PurchaseHistoryRepository $purchaseHistoryRepo)
    {
        $this->purchaseHistoryRepository = $purchaseHistoryRepo;
    }

    /**
     * Display a listing of the PurchaseHistory.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $purchaseHistories = $this->purchaseHistoryRepository->all();

        return view('purchase_histories.index')
            ->with('purchaseHistories', $purchaseHistories);
    }

    /**
     * Show the form for creating a new PurchaseHistory.
     *
     * @return Response
     */
    public function create()
    {
        return view('purchase_histories.create');
    }

    /**
     * Store a newly created PurchaseHistory in storage.
     *
     * @param CreatePurchaseHistoryRequest $request
     *
     * @return Response
     */
    public function store(CreatePurchaseHistoryRequest $request)
    {
        $input = $request->all();

        $purchaseHistory = $this->purchaseHistoryRepository->create($input);

        Flash::success('Purchase History saved successfully.');

        return redirect(route('purchaseHistories.index'));
    }

    /**
     * Display the specified PurchaseHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $purchaseHistory = $this->purchaseHistoryRepository->find($id);

        if (empty($purchaseHistory)) {
            Flash::error('Purchase History not found');

            return redirect(route('purchaseHistories.index'));
        }

        return view('purchase_histories.show')->with('purchaseHistory', $purchaseHistory);
    }

    /**
     * Show the form for editing the specified PurchaseHistory.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $purchaseHistory = $this->purchaseHistoryRepository->find($id);

        if (empty($purchaseHistory)) {
            Flash::error('Purchase History not found');

            return redirect(route('purchaseHistories.index'));
        }

        return view('purchase_histories.edit')->with('purchaseHistory', $purchaseHistory);
    }

    /**
     * Update the specified PurchaseHistory in storage.
     *
     * @param int $id
     * @param UpdatePurchaseHistoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePurchaseHistoryRequest $request)
    {
        $purchaseHistory = $this->purchaseHistoryRepository->find($id);

        if (empty($purchaseHistory)) {
            Flash::error('Purchase History not found');

            return redirect(route('purchaseHistories.index'));
        }

        $purchaseHistory = $this->purchaseHistoryRepository->update($request->all(), $id);

        Flash::success('Purchase History updated successfully.');

        return redirect(route('purchaseHistories.index'));
    }

    /**
     * Remove the specified PurchaseHistory from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $purchaseHistory = $this->purchaseHistoryRepository->find($id);

        if (empty($purchaseHistory)) {
            Flash::error('Purchase History not found');

            return redirect(route('purchaseHistories.index'));
        }

        $this->purchaseHistoryRepository->delete($id);

        Flash::success('Purchase History deleted successfully.');

        return redirect(route('purchaseHistories.index'));
    }
}
