<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Punishment
 *
 * @package App
 *
 * @property int id
 * @property int to_resident_id
 * @property int user_id
 * @property string description
 * @property Carbon start_at
 * @property Carbon end_at
 * @property Carbon finished_at
 * @property User user
 * @property Resident resident
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Punishment extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resident()
    {
        return $this->belongsTo('App\Resident', 'to_resident_id');
    }
}
