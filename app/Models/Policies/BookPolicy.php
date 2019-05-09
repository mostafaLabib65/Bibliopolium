<?php

namespace App\Models\Policies;

use App\User;
use App\Models\Book;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Model;

class BookPolicy extends BasePolicy
{
    protected $model = 'book';


}
