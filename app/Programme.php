<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
  protected $table = 'programmes';
   protected $fillable = [
    'programme_code', 'programme_name', 'department_id'
    ];

  public function courses(){
      return $this->belongsToMany('App\Course') 
      ->withPivot('semester_taken','elective','selected','tutor_id')->orderby('semester_taken','asc')->withTimestamps();
    }

   public function course_programme(){

    return $this->hasMany(Course_Programme::class);
  }
    
    public function department(){

    return $this->belongsTo(Department::class);
  }

   public function user(){
      return $this->belongsTo(User::class);
    
   } 

   public function semester(){
      return $this->belongsTo(Semester::class);
    
   } 

}
