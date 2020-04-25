<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ResidentParent
 *
 * @package App
 *
 * @property int id
 * @property string firstname
 * @property string lastname
 * @property string patronimyc
 * @property string gender
 * @property string birthday
 * @property string phone
 * @property string about
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property Resident resident
 * @property string fullname
 * @property string gender_title
 * @property string role
 * @property string link
 */
class ResidentParent extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'patronimyc', 'gender', 'role', 'birthday', 'phone', 'about'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['birthday'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resident()
    {
        return $this->belongsTo('App\Resident');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notes()
    {
        return $this->morphMany('App\Note', 'notable')
            ->orderByDesc('created_at');
    }

    /**
     * Get fullname attribute value.
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return "$this->lastname $this->firstname $this->patronimyc";
    }

    /**
     * Get gender title value.
     *
     * @return string
     */
    public function getGenderTitleAttribute()
    {
        return $this->attributes['gender'] ? 'мужской' : 'женский';
    }

    /**
     * Get link attribute value.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return route('parents.show', [$this->id]);
    }
}
