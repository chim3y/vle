<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $table = 'lectures';
    protected $fillable = [
    'lecture_name', 'description', 'document'
    ];


 public function course(){
      return $this->belongsTo(Course::class);
    
   } 
  public function content(){
      return $this->belongsTo(Content::class);
    
   } 
}
