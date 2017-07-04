<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class AttemptQuiz extends Model
{
    protected $table = 'attempt_quiz';
    protected $fillable = [
    'user_id', 'admin_id', 'attempt', 'quiz_id'
    ];
protected $dates = ['started_at', 'ended_at'];


public function user(){
      return $this->belongsTo(User::class);
    
} 

 public function admin(){
      return $this->belongsTo(Admin::class);
    
} 

 public function quiz(){
      return $this->belongsTo(Quiz::class);
    
} 




}
