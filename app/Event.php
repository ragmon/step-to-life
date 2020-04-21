<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Event
 *
 * @package App
 *
 * @property int id
 * @property int user_id
 * @property string title
 * @property string description
 * @property string icon
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string publish_at
 */
class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'icon'];

    /**
     * Get publish at attribute value.
     *
     * @return string
     */
    public function getPublishAtAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }
}
