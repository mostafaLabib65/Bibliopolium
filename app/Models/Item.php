<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Item
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 *
 * @property \App\Models\ActiveCart cart
 * @property \App\Models\BookEdition book
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer book_id
 * @property integer quantity
 * @property integer edition
 */
class Item extends Model
{
//    use SoftDeletes;

    public $table = 'items';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'cart_id',
        'book_id',
        'quantity',
        'edition'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cart_id' => 'integer',
        'book_id' => 'integer',
        'quantity' => 'integer',
        'edition' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'cart_id' => 'required',
        'book_id' => 'required',
        'quantity' => 'required',
        'edition' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cart()
    {
        return $this->belongsTo(\App\Models\ActiveCart::class, 'cart_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\BookEdition::class, 'book_id');
    }
}
