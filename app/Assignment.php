<?php

namespace App;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
      protected $table = 'Assignments';
    protected $fillable = [
    'start_date','due_date','assignment_title', 'description', 'document', 'max_grade',
    ];


public function setStartDateAttribute($date){
	$this->attributes['start_date']= Carbon::parse($date);
}
public function setDueDateAttribute($date){
	$this->attributes['due_date']= Carbon::parse($date);
}
 public function course(){
      return $this->belongsTo(Course::class);
    
   } 
  public function content(){
      return $this->belongsTo(Content::class);
    
   }
}
