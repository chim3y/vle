<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer_User extends Model
{
      protected $table = 'answer_user';
    protected $fillable = [
    'attemptquiz_id',  'question_id', 'answer_id', 'marks', 'attempt_id'
    ];





 public function question(){
      return $this->belongsTo(Question::class);
    
} 

 public function answer(){
      return $this->belongsTo(Answer::class);
    
} 

 public function user(){
      return $this->belongsTo(User::class);
    
} 

 public function attemptquiz(){
      return $this->belongsTo(AttemptQuiz::class);
    
} 
}
