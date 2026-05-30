<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nis',
        'name',
        'class',
        'gender',
        'status'
    ];

    /**
     * Get the user that owns the student profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attendance records for this student.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * Get the grades for this student.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * Get the SPP payment records for this student.
     */
    public function sppPayments()
    {
        return $this->hasMany(SppPayment::class);
    }

    /**
     * Get the uploaded files for this student.
     */
    public function files()
    {
        return $this->hasMany(StudentFile::class);
    }
}
