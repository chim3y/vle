<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
     protected $table = 'students';
      protected $fillable = [
    'user_id', 'fname', 'mname', 'lname', 'cid','sex', 'dob','programme_id', 'current_semester', 'bloodgroup','street_name', 'isApproved'
    ];




public function user(){
      return $this->belongsTo(User::class);
    
   } 

 public function course(){
         return $this->belongsToMany(Course::class,'course_student','course_id','student_id')->withTimestamps();
    
   } 
}
