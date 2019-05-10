<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Book
 *
 * @package App\Models
 * @version May 7, 2019, 8:58 pm UTC
 * @property \App\Models\Author author
 * @property \Illuminate\Database\Eloquent\Collection activeOrders
 * @property \App\Models\BookEdition bookEdition
 * @property \App\Models\BookIsbn bookIsbn
 * @property \Illuminate\Database\Eloquent\Collection historyOrders
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \App\Models\Statistic statistic
 * @property string title
 * @property integer author_id
 * @property float price
 * @property string category
 * @property integer threshold
 * @property integer no_of_copies
 * @property int $id
 * @property string $title
 * @property float $price
 * @property string $category
 * @property int $threshold
 * @property int $no_of_copies
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ActiveOrder[] $activeOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Author[] $authors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookEdition[] $bookEdition
 * @property-read \App\Models\BookIsbn $bookIsbn
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HistoryOrder[] $historyOrders
 * @property-read \App\Models\Statistic $statistic
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereNoOfCopies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereThreshold($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Book extends Model
{
//    use SoftDeletes;

    public $table = 'books';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'price',
        'category',
        'threshold',
        'no_of_copies',
        'publisher_id',
        'publishing_year',
        'edition',
        'isbn'

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'price' => 'float',
        'category' => 'string',
        'threshold' => 'integer',
        'no_of_copies' => 'integer',
        'publisher_id' => 'integer',
        'publishing_year' => 'integer',
        'edition' => 'integer',
        'isbn' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'price' => 'required',
        'category' => 'required',
        'threshold' => 'required',
      //  'no_of_copies' => 'required',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function authors()
    {
        return $this->hasMany(\App\Models\Author::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function activeOrders()
    {
        return $this->hasMany(\App\Models\ActiveOrder::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function bookEdition()
    {
        return $this->hasMany(\App\Models\BookEdition::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function bookIsbn()
    {
        return $this->hasOne(\App\Models\BookIsbn::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function historyOrders()
    {
        return $this->hasMany(\App\Models\HistoryOrder::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function statistic()
    {
        return $this->hasOne(\App\Models\Statistic::class);
    }
}
