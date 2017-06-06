<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Course_Programme extends Model
{
   protected $table = 'course_programme';
    protected $fillable = [
    'course_id', 'programme_id','created_at', 'updated_at', 'enrollment_key'
    ];

 
     public function programmes()
    {
        return $this->hasMany('App\Programme');
    }

     public function courses()
    {
        return $this->hasMany('App\Course');
    }

     public function semesters()
    {
        return $this->hasMany('App\Semester');
    }


}
