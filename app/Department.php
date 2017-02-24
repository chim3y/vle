<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $table = 'departments';
 protected $fillable = [
   'department_code', 'department_name',  'tutor_id',
    ];
      public function programmes(){

    return $this->hasMany(Programme::class);
  }

     public function tutor(){

    return $this->belongsTo(Tutor::class);
  }

   public function user(){
      return $this->belongsTo(User::class);
    
   } 

}
