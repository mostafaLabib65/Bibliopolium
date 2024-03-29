<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStatisticRequest;
use App\Http\Requests\UpdateStatisticRequest;
use App\Models\Statistic;
use App\Repositories\StatisticRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class StatisticController extends AppBaseController
{
    /** @var  StatisticRepository */
    private $statisticRepository;

    public function __construct(StatisticRepository $statisticRepo)
    {
        $this->statisticRepository = $statisticRepo;
    }

    /**
     * Display a listing of the Statistic.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $this->authorize('index', Statistic::class);

        $top_books = \DB::select("CALL top_selling_books");
        $top_books = static::modelsFromRawResults($top_books, Statistic::class);

        $top_customers = \DB::select("CALL top_customers");
        $top_customers = static::modelsFromRawResults($top_customers, Statistic::class);

        $total_sales = \DB::select("CALL total_sales");
        $total_sales = static::modelsFromRawResults($total_sales, Statistic::class);
        dd($total_sales);
        return view('statistics.index')
            ->with('top_books', $top_books)
            ->with('top_customers', $top_customers)
            ->with('total_sales', $total_sales);
    }

    public function report_top_books()
    {
        $this->authorize('index', Statistic::class);

        $top_books = \DB::select("CALL top_selling_books");
        $top_books = static::modelsFromRawResults($top_books, Statistic::class);


        $pdf = \PDF::loadView('statistics.reports.top_books', ['top_books' => $top_books]);

        return $pdf->download('report.pdf');
    }

    public function report_top_customers()
    {
        $this->authorize('index', Statistic::class);


        $top_customers = \DB::select("CALL top_customers");
        $top_customers = static::modelsFromRawResults($top_customers, Statistic::class);;

        $pdf = \PDF::loadView('statistics.reports.top_books', ['top_customers' => $top_customers]);

        return $pdf->download('report.pdf');
    }


    public function report_top_sales()
    {
        $this->authorize('index', Statistic::class);


        $total_sales = \DB::select("CALL total_sales");
        $total_sales = static::modelsFromRawResults($total_sales, Statistic::class);

        $pdf = \PDF::loadView('statistics.reports.top_books', ['total_sales' => $total_sales]);

        return $pdf->download('report.pdf');
    }

    /**
     * Show the form for creating a new Statistic.
     *
     * @return Response
     */
//    public function create()
//    {
//        return view('statistics.create');
//    }
//
//    /**
//     * Store a newly created Statistic in storage.
//     *
//     * @param CreateStatisticRequest $request
//     *
//     * @return Response
//     */
//    public function store(CreateStatisticRequest $request)
//    {
//        $input = $request->all();
//
//        $statistic = $this->statisticRepository->create($input);
//
//        Flash::success('Statistic saved successfully.');
//
//        return redirect(route('statistics.index'));
//    }
//
//    /**
//     * Display the specified Statistic.
//     *
//     * @param int $id
//     *
//     * @return Response
//     */
//    public function show($id)
//    {
//        $statistic = $this->statisticRepository->find($id);
//
//        if (empty($statistic)) {
//            Flash::error('Statistic not found');
//
//            return redirect(route('statistics.index'));
//        }
//
//        return view('statistics.show')->with('statistic', $statistic);
//    }
//
//    /**
//     * Show the form for editing the specified Statistic.
//     *
//     * @param int $id
//     *
//     * @return Response
//     */
//    public function edit($id)
//    {
//        $statistic = $this->statisticRepository->find($id);
//
//        if (empty($statistic)) {
//            Flash::error('Statistic not found');
//
//            return redirect(route('statistics.index'));
//        }
//
//        return view('statistics.edit')->with('statistic', $statistic);
//    }
//
//    /**
//     * Update the specified Statistic in storage.
//     *
//     * @param int $id
//     * @param UpdateStatisticRequest $request
//     *
//     * @return Response
//     */
//    public function update($id, UpdateStatisticRequest $request)
//    {
//        $statistic = $this->statisticRepository->find($id);
//
//        if (empty($statistic)) {
//            Flash::error('Statistic not found');
//
//            return redirect(route('statistics.index'));
//        }
//
//        $statistic = $this->statisticRepository->update($request->all(), $id);
//
//        Flash::success('Statistic updated successfully.');
//
//        return redirect(route('statistics.index'));
//    }
//
//    /**
//     * Remove the specified Statistic from storage.
//     *
//     * @param int $id
//     *
//     * @throws \Exception
//     *
//     * @return Response
//     */
//    public function destroy($id)
//    {
//        $statistic = $this->statisticRepository->find($id);
//
//        if (empty($statistic)) {
//            Flash::error('Statistic not found');
//
//            return redirect(route('statistics.index'));
//        }
//
//        $this->statisticRepository->delete($id);
//
//        Flash::success('Statistic deleted successfully.');
//
//        return redirect(route('statistics.index'));
//    }
}
