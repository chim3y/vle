<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{    
	protected $table = 'semesters';

public function courses(){
      return $this->hasMany('App\Course') 
      ->withPivot('elective','selected','tutor_id')>withTimestamps();
    }

public function programme(){
      return $this->hasMany('App\Course') 
      ->withPivot('elective','selected','tutor_id')->withTimestamps();
    }

    
}

