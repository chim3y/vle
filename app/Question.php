<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
     protected $table = 'questions';
    protected $fillable = [
    'question', 'type', 'user_id', 'admin_id' ];

 public function quizes(){
      return $this->belongsToMany(Semester::class,'quiz_question','question_id','quiz_id')->withTimestamps();
    
   } 

  public function answer(){
      return $this->hasMany(Answer::class);
    
   } 
 public function user(){
      return $this->belongsTo(User::class);
    
   } 
 public function admin(){
      return $this->belongsTo(Admin::class);
    
   } 


   public function useranswer(){
      return $this->belongsToMany(Question::class,'answer_user','question_id','answer_id')->withPivot('user_id','quiz_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function quiz(){
      return $this->belongsToMany(Quiz::class,'answer_user','question_id','quiz_id')->withPivot('user_id','question_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

public function users(){
      return $this->belongsToMany(User::class,'answer_user','question_id','user_id')->withPivot('question_id','quiz_id','admin_id','marks', 'attempt_id')->withTimestamps();
    
   } 


public function admins(){
      return $this->belongsToMany(Admin::class,'answer_user','question_id','admin_id')->withPivot('user_id','quiz_id','question_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

   public function attempt(){
      return $this->belongsToMany(Admin::class,'answer_user','question_id','attempt_id')->withPivot('answer_id','quiz_id','user_id', 'marks', 'admin_id')->withTimestamps();
    
   } 


   
}
