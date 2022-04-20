<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Students;

class ClassModel extends Model
{
    use HasFactory;
    protected $table='class';//define that this model is related to class table

    public function student(){
        return $this->hasMany(Student::class);
    }
}
