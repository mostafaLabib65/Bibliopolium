<?php

namespace App\Repositories;

use App\Models\BookEdition;
use App\Repositories\BaseRepository;

/**
 * Class BookEditionRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class BookEditionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'edition',
        'publishing_year',
        'publisher_id',
        'no_of_copies'
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
        return BookEdition::class;
    }
}
