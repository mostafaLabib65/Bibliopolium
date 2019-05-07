<?php

namespace App\Repositories;

use App\Models\Publisher;
use App\Repositories\BaseRepository;

/**
 * Class PublisherRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class PublisherRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'address',
        'phone_number'
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
        return Publisher::class;
    }
}
