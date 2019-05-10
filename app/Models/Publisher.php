<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Publisher
 *
 * @package App\Models
 * @version May 7, 2019, 9:24 pm UTC
 * @property \Illuminate\Database\Eloquent\Collection bookEditions
 * @property \Illuminate\Database\Eloquent\Collection bookIsbns
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string name
 * @property string address
 * @property string phone_number
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone_number
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookEdition[] $bookEditions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\BookIsbn[] $bookIsbns
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Publisher whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Publisher extends Model
{
//    use SoftDeletes;

    public $table = 'publishers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'address',
        'phone_number'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'address' => 'string',
        'phone_number' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'address' => 'required',
        'phone_number' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function bookEditions()
    {
        return $this->hasMany(\App\Models\BookEdition::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function bookIsbns()
    {
        return $this->hasMany(\App\Models\BookIsbn::class);
    }
}
