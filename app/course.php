<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{

    protected $table = 'courses';
    protected $fillable = [
    'course_name', 'course_code', 'credits', 'description'
    ];


  public function user(){
      return $this->belongsTo(User::class);
    
   } 

public function semester(){
      return $this->belongsTo(Semester::class);
    
   } 

  public function programmes(){
      return $this->belongsToMany(Programme::class)->withPivot('semester_taken','elective','selected','tutor_id')->withTimestamps();
    }
    


  public function course_programme(){

    return $this->hasMany(Course_Programme::class)->withPivot('semester_taken','elective','selected','tutor_id')->withTimestamps();
  }
 
}
