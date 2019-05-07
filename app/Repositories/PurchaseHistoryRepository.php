<?php

namespace App\Repositories;

use App\Models\PurchaseHistory;
use App\Repositories\BaseRepository;

/**
 * Class PurchaseHistoryRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class PurchaseHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'timestamp',
        'total_price'
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
        return PurchaseHistory::class;
    }
}
