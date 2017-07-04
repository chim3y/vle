<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

	  protected $table = 'answers';
    protected $fillable = [
    'answer', 'is_correct' ,'question_id'    ];


     public function question(){
      return $this->belongsTo(Question::class);
    
} 

public function questions(){
      return $this->belongsToMany(Question::class,'answer_user','answer_id','question_id')->withPivot('user_id','quiz_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function quizes(){
      return $this->belongsToMany(Quiz::class,'answer_user','answer_id','quiz_id')->withPivot('user_id','question_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function users(){
      return $this->belongsToMany(User::class,'answer_user','answer_id','user_id')->withPivot('question_id','quiz_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 


public function admins(){
      return $this->belongsToMany(Admin::class,'answer_user','answer_id','admin_id')->withPivot('user_id','quiz_id','question_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function attempt(){
      return $this->belongsToMany(Admin::class,'answer_user','answer_id','attempt_id')->withPivot('user_id','quiz_id','question_id', 'marks', 'admin_id')->withTimestamps();
    
   } 

}
