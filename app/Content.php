<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
     protected $table = 'contents';
    protected $fillable = [
    'content_name', 'description'
    ];


    public function course(){
      return $this->belongsTo('App\Course');
    }

 public function lectures(){
      return $this->hasMany(lecture::class);
    
   } 

}
