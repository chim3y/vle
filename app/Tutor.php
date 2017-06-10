<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutors';
     protected $fillable = [
        'isApproved'
    ];


public function user(){
      return $this->belongsTo(User::class);
    
   } 

public function courses(){
      return $this->hasMany(Course::class);
    
   } 
}
