<?php

namespace App\Repositories;

use App\Models\AuthorBook;
use App\Repositories\BaseRepository;

/**
 * Class AuthorBookRepository
 * @package App\Repositories
 * @version May 9, 2019, 6:14 pm UTC
*/

class AuthorBookRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'author_id'
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
        return AuthorBook::class;
    }
}
