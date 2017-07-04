<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutors';
        protected $fillable = [
    'user_id', 'fname', 'mname', 'lname', 'cid','sex', 'dob','programme_id', 'current_semester', 'bloodgroup','street_name', 'isApproved'
    ];


public function user(){
      return $this->belongsTo(User::class);
    
   } 

public function courses(){
      return $this->hasMany(Course::class);
    
   } 

public function course(){
         return $this->belongsToMany(Course::class,'course_tutor','course_id','tutor_id')->withTimestamps();
    
   } 
}
