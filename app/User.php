<?php

namespace App;

use App\Models\ActiveCart;
use App\Models\Item;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @package App\Models
 * @version May 7, 2019, 9:00 pm UTC
 * @property \Illuminate\Database\Eloquent\Collection activeCarts
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \App\Models\PurchaseHistory purchaseHistory
 * @property string email
 * @property string first_name
 * @property string last_name
 * @property string shipping_address
 * @property string phone_number
 * @property float spent_money
 * @property string encrypted_password
 * @property string reset_password_token
 * @property string|\Carbon\Carbon reset_password_sent_at
 * @property string|\Carbon\Carbon remember_created_at
 * @property integer role
 * @property int $id
 * @property string $user_name
 * @property string $email
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $shipping_address
 * @property string|null $phone_number
 * @property float $spent_money
 * @property string $password
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ActiveCart[] $activeCarts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \App\Models\PurchaseHistory $purchaseHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereShippingAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSpentMoney($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUserName($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
//    use SoftDeletes;
    use HasRoles;

    public $table = 'users';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $guard_name = 'admin';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $fillable = [
        'user_name',
        'email',
        'first_name',
        'last_name',
        'shipping_address',
        'phone_number',
        'spent_money',
        'password',
        'reset_password_token',
        'reset_password_sent_at',
        'remember_created_at',
        'role'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_name' => 'string',
        'email' => 'string',
        'first_name' => 'string',
        'last_name' => 'string',
        'shipping_address' => 'string',
        'phone_number' => 'string',
        'spent_money' => 'float',
        'password' => 'string',
        'reset_password_token' => 'string',
        'reset_password_sent_at' => 'datetime',
        'remember_created_at' => 'datetime',
        'role' => 'string',
        'email_verified_at'=>'datetime'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_name' => 'required|unique:users,user_name',
        'email' => 'required|unique:users,email',
        'password' => 'required',
    ];

//    /**
//     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
//     **/
//    public function role()
//    {
//        return $this->belongsTo(\App\Models\RoleCredential::class, 'role');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activeCarts()
    {
        return $this->hasMany(\App\Models\ActiveCart::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function purchaseHistory()
    {
        return $this->hasOne(\App\Models\PurchaseHistory::class);
    }

    public function items(){
        return $this->hasManyThrough(Item::class,ActiveCart::class,'id','cart_id');
    }
}
