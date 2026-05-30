<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'month',
        'year',
        'amount',
        'status',
        'payment_date'
    ];

    /**
     * Get the student associated with this payment.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
