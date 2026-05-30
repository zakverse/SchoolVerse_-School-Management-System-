<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'title',
        'file_path',
        'file_type',
        'file_size'
    ];

    /**
     * Get the student that owns the file.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
