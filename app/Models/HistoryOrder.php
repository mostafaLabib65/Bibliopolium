<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HistoryOrder
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 *
 * @property \App\Models\Book book
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer book_id
 * @property integer quantity
 * @property string order_timestamp
 * @property integer status
 * @property string history_timestamp
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
        'order_id' => 'integer',
        'book_id' => 'integer',
        'quantity' => 'integer',
        'order_timestamp' => 'date',
        'status' => 'integer',
        'history_timestamp' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required',
        'book_id' => 'required',
        'quantity' => 'required',
        'order_timestamp' => 'required',
        'status' => 'required',
        'history_timestamp' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }
}