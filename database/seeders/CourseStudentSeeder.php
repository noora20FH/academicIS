<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CourseStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course_student =[
            [
                'student_id' => 1,
                'course_id' => 1,
                'value' => 'A'
            ],
            [
                'student_id' => 1,
                'course_id' => 2,
                'value' => 'A'
            ],
            [
                'student_id' => 1,
                'course_id' => 3,
                'value' => 'A'
            ],
            [
                'student_id' => 1,
                'course_id' => 4,
                'value' => 'A'
            ],
        ];
        DB::table('course_student')->insert($course_student);
    }
}
