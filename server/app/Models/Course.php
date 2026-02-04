<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'hours',
        'price',
        'start_date',
        'end_date',
        'cover_img',
        'thumbnail_img'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2'
    ];

    public function lessons() 
    {
        return $this->hasMany(Lesson::class);
    }

    public function enrollments() 
    {
        return $this->hasMany(Enrollment::class);
    }

    public function canAddLesson() 
    {
        return $this->lessons()->count() < 5;
    }

    public function canInErollment()
    {
        $now = now()->toDate();
        return $this->start_date > now() && $this->end_date > now();
    }
}
