<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Resident
 *
 * @package App
 *
 * @property int id
 * @property string firstname
 * @property string lastname
 * @property string patronymic
 * @property bool gender
 * @property string gender_title
 * @property string phone
 * @property Carbon birthday
 * @property Carbon registered_at
 * @property string about
 * @property string source
 * @property int balance
 * @property bool status
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property string fullname
 * @property Collection tasks
 * @property Collection responsibilities
 * @property Collection punishments
 * @property Collection parents
 * @property string link
 */
class Resident extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'patronymic', 'gender', 'phone', 'birthday', 'registered_at',
        'about', 'source', 'balance', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function punishments()
    {
        return $this->hasMany('App\Punishment', 'to_resident_id')
            ->orderByDesc('created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tasks()
    {
        return $this->morphToMany('App\Task', 'taskable')
            ->withPivot('finished_at')
            ->orderByDesc('created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responsibilities()
    {
        return $this->belongsToMany('App\Responsibility');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctorAppointments()
    {
        return $this->hasMany('App\DoctorAppointment');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parents()
    {
        return $this->hasMany('App\ResidentParent');
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
     * Get full name attribute value.
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return "$this->firstname $this->lastname $this->patronymic";
    }

    /**
     * Get gender attribute value.
     *
     * @return string
     */
    public function getGenderTitleAttribute()
    {
        return $this->attributes['gender'] ? 'мужской' : 'женский';
    }

    /**
     * Get balance attribute value.
     *
     * @return string
     */
    public function getBalanceAttribute()
    {
        return "{$this->attributes['balance']} грн";
    }

    /**
     * Get status attribute value.
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'закончил реабилитацию' : 'в реабилитации';
    }

    /**
     * Get link attribute value.
     *
     * @return string
     */
    public function getLinkAttribute()
    {
        return route('residents.show', [$this->id]);
    }
}
