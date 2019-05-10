<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PurchaseHistory
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \App\Models\User userName
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string timestamp
 * @property float total_price
 * @property int $id
 * @property int|null $user_id
 * @property int $no_of_items
 * @property float $total_price
 * @property string $status
 * @property \Illuminate\Support\Carbon $cart_created_at
 * @property \Illuminate\Support\Carbon|null $cart_updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereCartCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereCartUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereNoOfItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PurchaseHistory whereUserId($value)
 * @mixin \Eloquent
 */
class PurchaseHistory extends Model
{
//    use SoftDeletes;

    public $table = 'purchase_histories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'no_of_items',
        'status',
        'cart_created_at',
        'cart_updated_at',
        'total_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'no_of_items' => 'integer',
        'total_price' => 'float',
        'status' => 'string',
        'cart_created_at' => 'date',
        'cart_updated_at' => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id' => 'required',
        'user_id' => 'required',
        'total_price' => 'required',
        'no_of_items' => 'required',
        'status' => 'required',
        'cart_created_at' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}
