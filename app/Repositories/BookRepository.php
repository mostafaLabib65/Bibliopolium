<?php

namespace App\Repositories;

use App\Models\Book;
use App\Repositories\BaseRepository;

/**
 * Class BookRepository
 * @package App\Repositories
 * @version May 7, 2019, 8:58 pm UTC
*/

class BookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'author_id',
        'price',
        'category',
        'threshold',
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
        return Book::class;
    }
}
