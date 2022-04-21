<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Student as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent
use App\Models\ClassModel;

class Student extends Model // Model definition
{
    protected $table='student_'; // Eloquent will create a student model to store records in the student table
    protected $primaryKey = 'id_student'; // Calling DB contents with primary key
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    //Guarded is the reverse of fillable. If fillable specifies which fields to be mass assigned,
    // guarded specifies which fields are not mass assignable.
    //protected $guarded =['id_student'];//
    protected $fillable = [
        'Nim',
        'Name',
        'class_id',
        'Major',
        'Address',
        'Date_of_Birth',
    ];
    /*
    'Nim',
    'Name',
    'class_id',
    'Major',
    'Address',
    'Date_of_Birth',
    */

    public function class(){
        return $this->belongsTo(ClassModel::class);
    }

    public function course(){
        return $this->belongsToMany(Course::class, 'course_student', 'student_id')
        ->withPivot('value');

    }

    public function search($query, array $searching)
    {
        $query->when($searching['search'] ?? false, function($query, $search){
            return $query->where('name', 'like', '%'.$search.'%');
        });
    }

}
