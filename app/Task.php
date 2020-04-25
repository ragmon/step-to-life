<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Task
 *
 * @package App
 *
 * @property int id
 * @property int user_id
 * @property string title
 * @property string description
 * @property Carbon start_at
 * @property Carbon end_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property Collection users
 * @property Collection residents
 * @property User user
 * @property string link
 */
class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'title', 'description', 'start_at', 'end_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_at', 'end_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function taskable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function users()
    {
        return $this->morphedByMany('App\User', 'taskable')
            ->withPivot('finished_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function residents()
    {
        return $this->morphedByMany('App\Resident', 'taskable')
            ->withPivot('finished_at');
    }

    /**
     * Get link attribute value.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return route('tasks.show', [$this->id]);
    }
}
