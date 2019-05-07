<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PurchaseHistory
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 *
 * @property \App\Models\User userName
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string timestamp
 * @property float total_price
 */
class PurchaseHistory extends Model
{
    use SoftDeletes;

    public $table = 'purchase_histories';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'timestamp',
        'total_price'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_name' => 'string',
        'timestamp' => 'date',
        'total_price' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_name' => 'required',
        'timestamp' => 'required',
        'total_price' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function userName()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_name');
    }
}
