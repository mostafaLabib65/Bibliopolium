<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Item
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \App\Models\ActiveCart cart
 * @property \App\Models\BookEdition book
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer book_id
 * @property integer quantity
 * @property integer edition
 * @property int $cart_id
 * @property int $book_id
 * @property int $edition
 * @property int $quantity
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BookEdition $book
 * @property-read \App\Models\ActiveCart $cart
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCartId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereEdition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Item whereUpdatedAt($value)
 * @mixin \Eloquent
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
