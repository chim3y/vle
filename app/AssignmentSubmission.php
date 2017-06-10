<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
     protected $table = 'assignmentsubmissions';
    protected $fillable = [
    'description','document','assignment_id', 'user_id', 'admin_id'
    ];


 public function user(){
      return $this->belongsTo(User::class);
    
} 

 public function admin(){
      return $this->belongsTo(Admin::class);
    
} 

public function assignment(){
      return $this->belongsTo(Assignment::class);
    
} 
}
