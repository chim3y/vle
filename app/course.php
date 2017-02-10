<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'course_name', 'course_code', 'programme_code', 'credits','start_date', 'end_date', 'description', 'class_no', 'building_no'
    ];

}
