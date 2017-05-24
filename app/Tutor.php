<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutors';


public function user(){
      return $this->belongsTo(User::class);
    
   } 
}
