<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
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
  public function roles(){
      return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
}

  public function hasAnyRole($roles){
    if (is_array($roles)) {
      foreach ($roles as $role) {
      return true;
      }
      }
      else {
        if($this->hasRole($roles)){
          return true;
        }
      return true;
}
}

  public function hasRole($role){

        if($this->roles()->where('role_name', $role)->first()){
          return true;
        }
      return false;
}


  public function tutor(){
      return $this->hasMany(Tutor::class);
 } 

 public function student(){
      return $this->hasMany(Student::class);
 } 

   public function assignmentsubmission(){
      return $this->hasMany(AssignmentSubmission::class);
    
   } 


   public function questions(){
      return $this->belongsToMany(Question::class,'answer_user','user_id','question_id')->withPivot('answer_id','quiz_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function quizes(){
      return $this->belongsToMany(Quiz::class,'answer_user','user_id','quiz_id')->withPivot('answer_id','question_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function answers(){
      return $this->belongsToMany(Answer::class,'answer_user','user_id','answer_id')->withPivot('question_id','quiz_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 


public function admins(){
      return $this->belongsToMany(Admin::class,'answer_user','user_id','admin_id')->withPivot('answer_id','attempt_id','quiz_id','question_id', 'marks')->withTimestamps();
    
   } 

public function attempt(){
      return $this->belongsToMany(Admin::class,'answer_user','user_id','attempt_id')->withPivot('answer_id','quiz_id','question_id', 'marks', 'admin_id')->withTimestamps();
    
   } 



    public function attemptquiz(){
      return $this->hasMany(AttemptQuiz::class);
    
   }    

}