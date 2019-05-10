<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ActiveOrder
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \App\Models\Book book
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer book_id
 * @property integer quantity
 * @property string order_timestamp
 * @property int $id
 * @property int $book_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ActiveOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ActiveOrder extends Model
{
//    use SoftDeletes;

    public $table = 'active_orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'book_id',
        'quantity',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'book_id' => 'integer',
        'quantity' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'book_id' => 'required',
//        'quantity' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }
}
