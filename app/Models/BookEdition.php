<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class BookEdition
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \App\Models\Book book
 * @property \App\Models\Publisher publisher
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection items
 * @property integer edition
 * @property string publishing_year
 * @property integer publisher_id
 * @property integer no_of_copies
 * @property int $book_id
 * @property int $edition
 * @property int $publisher_id
 * @property int|null $publishing_year
 * @property int $no_of_copies
 * @property string $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Book $book
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Item[] $items
 * @property-read \App\Models\Publisher $publisher
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition whereEdition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition whereNoOfCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition wherePublisherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition wherePublishingYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\BookEdition whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BookEdition extends Model
{
//    use SoftDeletes;

    public $table = 'book_editions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    public $timestamps = false;

    public $fillable = [
        'book_id',
        'edition',
        'publishing_year',
        'publisher_id',
        'no_of_copies'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'book_id' => 'integer',
        'edition' => 'integer',
        'publishing_year' => 'integer',
        'publisher_id' => 'integer',
        'no_of_copies' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'book_id' => 'required',
        'edition' => 'required',
        'publishing_year' => 'required',
        'publisher_id' => 'required',
        'no_of_copies' => 'required'
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function items()
    {
        return $this->hasMany(\App\Models\Item::class);
    }
}
