<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DoctorAppointment
 *
 * @package App
 *
 * @property int id
 * @property int resident_id
 * @property string doctor
 * @property string drug
 * @property string reception_schedule
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property Resident resident
 */
class DoctorAppointment extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function resident()
    {
        return $this->belongsTo('App\Resident');
    }
}
