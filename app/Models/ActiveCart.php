<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ActiveCart
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 *
 * @property \App\Models\User userName
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \App\Models\Item item
 * @property string user_name
 * @property string timestamp
 * @property integer status
 * @property integer no_of_items
 */
class ActiveCart extends Model
{
    use SoftDeletes;

    public $table = 'active_carts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_name',
        'timestamp',
        'status',
        'no_of_items'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_name' => 'string',
        'cart_id' => 'integer',
        'timestamp' => 'date',
        'status' => 'integer',
        'no_of_items' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_name' => 'required',
        'cart_id' => 'required',
        'timestamp' => 'required',
        'status' => 'required',
        'no_of_items' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userName()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function item()
    {
        return $this->hasOne(\App\Models\Item::class);
    }
}
