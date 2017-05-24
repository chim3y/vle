<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
     protected $table = 'quizes';
    protected $fillable = [
    'quiz_name', 'course_id', 'content_id'
    ];

  public function content(){
      return $this->belongsTo(Content::class);
    
   } 

  public function course(){
      return $this->belongsTo(Course::class);
    
   } 

}
