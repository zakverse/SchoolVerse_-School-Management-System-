<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject',
        'class',
        'day',
        'start_time',
        'end_time',
        'room'
    ];

    /**
     * Get the teacher who teaches this schedule.
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the attendance records for this schedule.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
