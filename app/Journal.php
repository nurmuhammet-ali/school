<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['semester', 'week', 'day', 'lesson', 'topic', 'grade_id', 'students'];
}
