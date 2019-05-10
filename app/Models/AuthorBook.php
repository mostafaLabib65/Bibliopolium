<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AuthorBook
 *
 * @package App\Models
 * @version May 9, 2019, 6:14 pm UTC
 * @property \App\Models\Author author
 * @property \App\Models\Book book
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property integer author_id
 * @property int $book_id
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AuthorBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AuthorBook newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AuthorBook onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AuthorBook query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AuthorBook whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AuthorBook whereBookId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AuthorBook withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\AuthorBook withoutTrashed()
 * @mixin \Eloquent
 */
class AuthorBook extends Model
{
    use SoftDeletes;

    public $table = 'authors_books';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'author_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'book_id' => 'integer',
        'author_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'author_id' => 'required',
        'book_id' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function author()
    {
        return $this->belongsTo(\App\Models\Author::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class, 'book_id');
    }
}
