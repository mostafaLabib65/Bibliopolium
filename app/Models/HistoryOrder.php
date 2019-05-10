<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HistoryOrder
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
 * @property integer status
 * @property string history_timestamp
 * @property int $id
 * @property int $book_id
 * @property int $quantity
 * @property \Illuminate\Support\Carbon $order_created_at
 * @property string $status
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder whereOrderCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HistoryOrder whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HistoryOrder extends Model
{
//    use SoftDeletes;

    public $table = 'history_orders';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'book_id',
        'quantity',
        'order_timestamp',
        'status',
        'history_timestamp'
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
        'order_created_at' => 'date',
        'status' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'id' => 'required',
        'book_id' => 'required',
        'quantity' => 'required',
        'order_created_at' => 'required',
        'status' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }
}
