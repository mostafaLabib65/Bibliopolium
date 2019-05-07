<?php

namespace App\Repositories;

use App\User;
use App\Repositories\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 * @version May 7, 2019, 9:00 pm UTC
*/

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'email',
        'first_name',
        'last_name',
        'shipping_address',
        'phone_number',
        'spent_money',
        'encrypted_password',
        'reset_password_token',
        'reset_password_sent_at',
        'remember_created_at',
        'role'
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
        return User::class;
    }
}
