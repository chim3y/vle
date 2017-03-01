<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
  protected $table = 'programmes';
   protected $fillable = [
    'programme_code', 'programme_name', 'department_id'
    ];

  public function courses(){
      return $this->belongsToMany('App\Course','course_programme','programme_id','course_id') 
      ->withPivot('semester_id','elective','selected')->withTimestamps();
    }
  public function semesters(){
      return $this->belongsToMany('App\Course','course_programme','programme_id','semester_id') 
      ->withPivot('course_id','elective','selected')->withTimestamps();
    }



   public function course_programme(){

    return $this->belongsTo(Course_Programme::class)->withPivot('elective','selected')->withTimestamps;
  }
    
    public function department(){

    return $this->belongsTo(Department::class);
  }

   public function user(){
      return $this->belongsTo(User::class);
    
   } 

}
