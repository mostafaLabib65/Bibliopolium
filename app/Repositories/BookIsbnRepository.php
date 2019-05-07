<?php

namespace App\Repositories;

use App\Models\BookIsbn;
use App\Repositories\BaseRepository;

/**
 * Class BookIsbnRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class BookIsbnRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'publisher_id',
        'isbn'
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
        return BookIsbn::class;
    }
}
