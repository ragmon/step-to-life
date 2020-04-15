<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Note
 *
 * @package App
 *
 * @property int id
 * @property int user_id
 * @property string content
 * @property User user
 */
class Note extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function notable()
    {
        return $this->morphTo();
    }
}
