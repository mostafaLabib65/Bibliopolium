<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\BaseRepository;

/**
 * Class ItemRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class ItemRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'book_id',
        'quantity',
        'edition'
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
        return Item::class;
    }
}
