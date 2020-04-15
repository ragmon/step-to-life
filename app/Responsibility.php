<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Responsibility
 *
 * @package App
 *
 * @property int id
 * @property string name
 * @property string about
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 * @property Collection residents
 */
class Responsibility extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function residents()
    {
        return $this->belongsToMany('App\Resident');
    }
}
