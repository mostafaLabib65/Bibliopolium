<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BookIsbn
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \App\Models\Book book
 * @property \App\Models\Publisher publisher
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer publisher_id
 * @property integer isbn
 * @property int $book_id
 * @property int $publisher_id
 * @property string $isbn
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \App\Models\Publisher $publisher
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn wherePublisherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookIsbn whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BookIsbn extends Model
{
//    use SoftDeletes;

    public $table = 'book_isbns';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'publisher_id',
        'isbn',
        'book_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'book_id' => 'integer',
        'publisher_id' => 'integer',
        'isbn' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'book_id' => 'required',
        'publisher_id' => 'required',
        'isbn' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function publisher()
    {
        return $this->belongsTo(\App\Models\Publisher::class, 'publisher_id');
    }
}
