<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{    
	protected $table = 'semesters';
	protected $fillable = [ 
    'semester_name'];


public function courses(){
      return $this->belongsToMany('App\Course', 'course_programme','semester_id','course_id')->withPivot('elective','selected')->withTimestamps();
    }

public function programmes(){
      return $this->belongsToMany('App\Programme', 'course_programme','semester_id','programme_id')->withPivot('elective','selected')->withTimestamps();
    }

  public function course_programme(){

    return $this->belongsTo(Course_Programme::class)->withPivot('elective', 'selected')->withTimestamps();
  }
    
}

