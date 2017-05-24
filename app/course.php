<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Course extends Model
{

    protected $table = 'courses';
    protected $fillable = [
    'course_name', 'course_code', 'credits', 'description'
    ];


 public function admin(){
      return $this->belongsTo(Admin::class);
    
   } 
 
 public function user(){
      return $this->belongsTo(User::class);
    
} 

public function semesters(){
      return $this->belongsToMany(Semester::class,'course_programme','course_id','semester_id')->withPivot('programme_id','elective','selected')->withTimestamps();
    
   } 

  public function programmes(){
      return $this->belongsToMany(Programme::class,'course_programme','course_id','programme_id')->withPivot('course_id','elective','selected')->withTimestamps();
    }
    


  public function course_programme(){

    return $this->belongsTo(Course_Programme::class);
  }
 
 public function contents(){
      return $this->hasMany(Content::class);
    
   }    

  public function lectures(){
      return $this->hasMany(lecture::class);
    
   } 

  public function quizes(){
      return $this->hasMany(Quiz::class);
    
   } 
}
