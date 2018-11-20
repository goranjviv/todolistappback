<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $fillable = [
        'title', 'text', 'priority', 'done', 'user_id'
    ];
}
