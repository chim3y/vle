<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   protected $table = 'admins';
    protected $fillable = [
        'name', 'email', 'password'
    ];
    
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
 public function courses(){
      return $this->hasMany(Course::class);
    
   } 

  public function assignmentsubmission(){
      return $this->hasMany(AssignmentSubmission::class);
    
   } 

 
}