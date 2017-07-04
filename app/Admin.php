<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $table = 'admins';
    protected $fillable = [
        'name', 'email', 'password'
    ];
    
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 public function courses(){
      return $this->hasMany(Course::class);
    
   } 
   public function question(){
      return $this->hasMany(Question::class);
    
   } 

  public function assignmentsubmission(){
      return $this->hasMany(AssignmentSubmission::class);
    
   } 


   public function questions(){
      return $this->belongsToMany(Question::class,'answer_user','admin_id','question_id')->withPivot('user_id','quiz_id','answer_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function quizes(){
      return $this->belongsToMany(Quiz::class,'answer_user','admin_id','quiz_id')->withPivot('user_id','question_id','answer_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function users(){
      return $this->belongsToMany(User::class,'answer_user','admin_id','user_id')->withPivot('question_id','quiz_id','answer_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 


public function answers(){
      return $this->belongsToMany(Admin::class,'answer_user','admin_id','answer_id')->withPivot('user_id','quiz_id','question_id', 'marks','attempt_id')->withTimestamps();
    
   } 

public function attempt(){
      return $this->belongsToMany(Admin::class,'answer_user','admin_id','attempt_id')->withPivot('answer_id','quiz_id','question_id', 'marks', 'user_id')->withTimestamps();
    
   } 


  public function attemptquiz(){
      return $this->hasMany(AttemptQuiz::class);
    
   }    

 
}