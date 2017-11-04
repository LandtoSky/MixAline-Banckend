<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLine extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'timelines';
    protected $fillable = [
        'user_id', 'title', 'start_date', 'end_date', 'color', 'description',
    ];
}
