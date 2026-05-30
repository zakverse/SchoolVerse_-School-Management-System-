<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'schedule_id',
        'date',
        'status'
    ];

    /**
     * Get the student associated with this attendance record.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the schedule associated with this attendance record.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
