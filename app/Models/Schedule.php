<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
  protected $fillable = [
    'lecturer_id',
    'course_id',
    'day_of_week',
    'start_time',
    'end_time',
    'room',
    ];  

    public function lecturer(): BelongsTo
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function course(): BelongsTo  
    {
        return $this->belongsTo(Course::class);
    }
}