<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class JobDescription
 *
 * @package App
 *
 * @property int id
 * @property string title
 * @property string content
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class JobDescription extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'content'];
}
