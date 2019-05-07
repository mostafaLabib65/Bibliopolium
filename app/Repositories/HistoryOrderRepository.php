<?php

namespace App\Repositories;

use App\Models\HistoryOrder;
use App\Repositories\BaseRepository;

/**
 * Class HistoryOrderRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class HistoryOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'book_id',
        'quantity',
        'order_timestamp',
        'status',
        'history_timestamp'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return HistoryOrder::class;
    }
}
