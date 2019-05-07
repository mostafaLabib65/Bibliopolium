<?php

namespace App\Repositories;

use App\Models\RoleCredential;
use App\Repositories\BaseRepository;

/**
 * Class RoleCredentialRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:24 pm UTC
*/

class RoleCredentialRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'role_name',
        'user_name',
        'decrypted_password'
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
        return RoleCredential::class;
    }
}
