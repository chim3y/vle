<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table = 'students';


public function user(){
      return $this->belongsTo(User::class);
    
   } 

 public function course(){
         return $this->belongsToMany(Course::class,'course_student','course_id','student_id')->withTimestamps();
    
   } 
}
