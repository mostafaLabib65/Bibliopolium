<?php

namespace App\Repositories;

use App\Models\Statistic;
use App\Repositories\BaseRepository;

/**
 * Class StatisticRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class StatisticRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sold_copies'
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
        return Statistic::class;
    }
}
