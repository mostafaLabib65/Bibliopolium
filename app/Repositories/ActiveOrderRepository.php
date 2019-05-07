<?php

namespace App\Repositories;

use App\Models\ActiveOrder;
use App\Repositories\BaseRepository;

/**
 * Class ActiveOrderRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class ActiveOrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'book_id',
        'quantity',
        'order_timestamp'
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
        return ActiveOrder::class;
    }
}
