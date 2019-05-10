<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Statistic
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \App\Models\Book book
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer sold_copies
 * @property int $book_id
 * @property int $sold_copies
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statistic whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statistic whereSoldCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Statistic whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Statistic extends Model
{
//    use SoftDeletes;

    public $table = 'statistics';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'sold_copies'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'book_id' => 'integer',
        'sold_copies' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'book_id' => 'required',
        'sold_copies' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }
}
