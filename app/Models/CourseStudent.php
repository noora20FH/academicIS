<?php

namespace App\Models;

use App\Models\Student;
use App\Modelst\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;
    protected $table= 'course_student';

    //To determine the table name of the relationship's intermediate table, Eloquent will join the 
    //two related model names in alphabetical order.
    
    // The third argument is the foreign key name of the model on which you are defining the relationship, 
    //while the fourth argument is the foreign key name of the model that you are joining to
    public function student(){
        return $this->belongsToMany(Student::class, 'course_student', 'course_id', 'student_id');
    }

    public function course(){
        return $this->belongsToMany(Course::class, 'course_student', 'course_id', 'student_id');
    }
}
