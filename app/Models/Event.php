<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'events';
    protected $fillable = [
        'title', 'start_date', 'end_date', 'description', 'align', 'visible', 'user_id', 'featured_image_url', 'image'
    ];
}
