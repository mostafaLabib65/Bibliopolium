<?php

namespace App\Repositories;

use App\Models\ActiveCart;
use App\Repositories\BaseRepository;

/**
 * Class ActiveCartRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class ActiveCartRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_name',
        'timestamp',
        'status',
        'no_of_items'
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
        return ActiveCart::class;
    }
}
