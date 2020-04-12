<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    public function punishments()
    {
        return $this->hasMany('App\Punishment', 'to_resident_id');
    }
}
