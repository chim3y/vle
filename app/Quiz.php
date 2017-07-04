<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
     protected $table = 'quizes';
    protected $fillable = [
    'quiz_name', 'course_id', 'content_id', 'max_attempt'
    ];

  public function content(){
      return $this->belongsTo(Content::class);
    
   } 

  public function course(){
      return $this->belongsTo(Course::class);
    
   } 

     public function questions(){
      return $this->belongsToMany(Question::class,'quiz_question','quiz_id','question_id')->withTimestamps();
    }

public function userquestions(){
      return $this->belongsToMany(Question::class,'answer_user','quiz_id','question_id')->withPivot('answer_id','user_id','admin_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 

   public function answers(){
      return $this->belongsToMany(Answer::class,'answer_user','quiz_id','answer_id')->withPivot('question_id','quiz_id','admin_id','marks','attempt_id')->withTimestamps();
    
   } 



public function users(){
      return $this->belongsToMany(User::class,'answer_user','quiz_id','user_id')->withPivot('admin_id','answer_id','question_id', 'marks', 'attempt_id')->withTimestamps();
    
   } 


public function admins(){
      return $this->belongsToMany(Admin::class,'answer_user','quiz_id','admin_id')->withPivot('user_id','answer_id','question_id', 'marks', 'attempt_id')->withTimestamps();
    
   }

     public function attemptquiz(){
      return $this->hasMany(AttemptQuiz::class);
    
   }   


   public function attempt(){
      return $this->belongsToMany(Admin::class,'answer_user','quiz_id','attempt_id')->withPivot('answer_id','quiz_id','question_id', 'marks', 'admin_id', 'user_id')->withTimestamps();
    
   } 



}
