<?php

namespace App;

use Carbon\Carbon;
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
 */
class Resident extends Model
{
    use SoftDeletes;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function punishments()
    {
        return $this->hasMany('App\Punishment', 'to_resident_id');
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
    public function getGenderAttribute()
    {
        return $this->attributes['gender'] ? 'мужской' : 'женский';
    }
}
