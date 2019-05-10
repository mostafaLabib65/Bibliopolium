<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ActiveCart
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \App\Models\User userName
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \App\Models\Item item
 * @property string user_name
 * @property string timestamp
 * @property integer status
 * @property integer no_of_items
 * @property int $id
 * @property int $user_id
 * @property int $no_of_items
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $item
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart whereNoOfItems($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveCart whereUserId($value)
 * @mixin \Eloquent
 */
class ActiveCart extends Model
{
//    use SoftDeletes;

    public $table = 'active_carts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'status',
        'no_of_items'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_name' => 'string',
        'cart_id' => 'integer',
        'status' => 'string',
        'no_of_items' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_name' => 'required',
        'id' => 'required',
        'status' => 'required',
        'no_of_items' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function item()
    {
        return $this->hasMany(\App\Models\Item::class,'cart_id');
    }
}
