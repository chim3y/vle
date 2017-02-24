<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Course_Programme extends Model
{
   protected $table = 'course_programme';
    protected $fillable = [
    'course_id', 'programme_id', 'semester_taken','created_at', 'updated_at'
    ];

    public function semesters()
    {
        return $this->belongsTo('App\Semester');
    }

     public function programmes()
    {
        return $this->belongsTo('App\Programme');
    }

     public function courses()
    {
        return $this->belongsTo('App\Course');
    }
}
