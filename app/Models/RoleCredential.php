<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class RoleCredential
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection users
 * @property string role_name
 * @property string user_name
 * @property string decrypted_password
 * @property int $id
 * @property string|null $role_name
 * @property string $user_name
 * @property string $decrypted_password
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleCredential newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleCredential newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleCredential query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleCredential whereDecryptedPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleCredential whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleCredential whereRoleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\RoleCredential whereUserName($value)
 * @mixin \Eloquent
 */
class RoleCredential extends Model
{
//    use SoftDeletes;

    public $table = 'role_credentials';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $timestamps=false;

    public $fillable = [
        'role_name',
        'user_name',
        'decrypted_password'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'role_name' => 'string',
        'user_name' => 'string',
        'decrypted_password' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id' => 'required',
        'user_name' => 'required',
        'decrypted_password' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function users()
    {
        return $this->hasMany(\App\User::class);
    }
}
