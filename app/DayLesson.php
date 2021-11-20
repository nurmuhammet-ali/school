<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DayLesson extends Model
{
    protected $table = 'day_lessons';
    protected $fillable = [
        'name',
        'topic',
        'mark',
        'day_id',
        'teacher_id'
    ];

    public function subject() 
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher() 
    {
        return $this->belongsTo(Teacher::class);
    }
}
