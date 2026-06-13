<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'schedule_id',
        'attended_at',
        'latitude',
        'longitude',
    ];

    public function schedule(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    protected function displayName(): \Illuminate\Database\Eloquent\Casts\Attribute
    {
        return \Illuminate\Database\Eloquent\Casts\Attribute::get(function (): string {
            $this->loadMissing('schedule.lecturer', 'schedule.course');

            return trim(sprintf(
                '%s - %s',
                $this->schedule?->display_name ?? '-',
                $this->attended_at?->format('d M Y H:i') ?? '',
            ), ' -');
        });
    
}
}