<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'instructor_id',
        'course_code',
        'credits',
        'semester',
        'year',
    ];

    /**
     * Get the instructor that teaches this course
     */
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    /**
     * Get the enrollments for this course
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get active enrollments count
     */
    public function getActiveEnrollmentsCountAttribute()
    {
        return $this->enrollments()->where('status', 'active')->count();
    }
}

