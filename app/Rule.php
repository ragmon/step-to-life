<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Rule
 *
 * @package App
 *
 * @property int id
 * @property int user_id
 * @property string title
 * @property string content
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property User user
 */
class Rule extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
