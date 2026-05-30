<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject',
        'category',
        'score',
        'notes'
    ];

    /**
     * Get the student associated with this grade.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
