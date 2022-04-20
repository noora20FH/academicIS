<?php
namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\ClassModel;

class StudentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        // the eloquent function to displays data
        $student = Student::with('class')->get();//to call class data that already has a relationship with the student
        //$student = DB::table('student_')->paginate(3);
        $paginate = Student::orderBy('id_student', 'asc')->paginate(3);
        return view('student.index', ['student_'=>$student,'paginate'=>$paginate]);
    }

    public function create()
    {
        $class = ClassModel::all();//get data from class table
        return view('student.create',['class' => $class]);
    }


    public function search(Request $request){
        $search = $request->search;
        $student = Student::where('name','like','%'.$search.'%')->paginate();
        return view('student.index', ['student_' => $student]);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
        'Nim' => 'required',
        'Name' => 'required',
        'Class' => 'required',
        'Major' => 'required',
        'Address' => 'required',
        'Date_of_Birth' => 'required',
        ]);

        $student = new Student;
        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        $student->class_id = $request->get('Class');
        $student->major = $request->get('Major');
        $student->Address = $request->get('Address');
        $student->Date_of_Birth = $request->get('Date_of_Birth');
        $student -> save();

        $class = new ClassModel;
        $class->id = $request->get('Class');
        
        // eloquent function to add data
        //Student::create($request->all());
        $student->class()->associate($class);
        $student->save();

        // if the data is added successfully, will return to the main page
        return redirect()->route('student.index') ->with('success', 'Student Successfully Added');
    }

    public function show($nim)
    {
        // displays detailed data by finding / by Student Nim
        //$Student = Student::where('nim', $nim)->first();
        //Student::with()  -> from student model
        $Student = Student::with('class')->where('nim',$nim)->first();
        //return view('student.detail', compact('Student'));
        return view('student.detail',['Student'=>$Student]);
    }

    public function edit($nim)
    {
        // displays detail data by finding based on Student Nim for editing
        $Student = Student::with('class')->where('nim', $nim)->first();
        //return view('student.edit', compact('Student'));
        $class = ClassModel::all();//take the data from class table
        return view('student.edit', compact('Student','class'));
        //return redirect()->route('student.index');
    }

    public function update(Request $request, $nim)
    {
        //validate the data
        $request->validate([
        'Nim' => 'required',
        'Name' => 'required',
        'Class' => 'required',
        'Major' => 'required',
        'Address' => 'required',
        'Date_of_Birth' => 'required',
        ]);
        //Eloquent function to update the data
        $student= Student::with('class')->where('nim', $nim)->first();
            // ->update([
            //'nim'=>$request->Nim,
            //'name'=>$request->Name,
            //'class'=>$request->Class,
            //'major'=>$request->Major,
            //'Address'=>$request->Address,
            //'Date_of_Birth'=>$request->Date_of_Birth,
            //]);
        $student->nim = $request->get('Nim');
        $student->name = $request->get('Name');
        //$student->class_id = $request->get('Class');
        $student->major = $request->get('Major');
        $student->Address = $request->get('Address');
        $student->Date_of_Birth = $request->get('Date_of_Birth');
        $student->save();

        $class = new ClassModel;
        $class->id = $request->get('Class');

            //eloquent function to update the data with belongs to relation
        $student->class()->associate($class);
        $student-> save();
        //if the data successfully updated, will return to main page
            return redirect()->route('student.index')
            ->with('success', 'Student Successfully Updated');
    }

    public function destroy( $nim)
    {
        //Eloquent function to delete the data
        Student::where('nim', $nim)->delete();
        return redirect()->route('student.index')
        -> with('success', 'Student Successfully Deleted');
    }
};