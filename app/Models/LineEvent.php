<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineEvent extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'line_event';
    protected $fillable = [
        'timeline_id', 'event_id'
    ];
}
