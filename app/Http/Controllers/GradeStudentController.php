<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeStudent;
use Illuminate\Support\Facades\DB;
/* ['grade_id','student_id'] */
class GradeStudentController extends Controller
{
    public function index(){
        /*$gradestudent = GradeStudent::join("grades","grades.id","=","grade_student.grade_id")->select("*")->groupBy("students.id"); 
        $gradestudent_2 = GradeStudent::join("students","students.id","=","grade_student.student_id")->select("*")->groupBy("grades.id")->union($gradestudent)->get();*/
        $gradestudent = DB::table('grade_student')
        ->join("grades","grades.id","=","grade_student.grade_id")
        ->join("students","students.id","=","grade_student.student_id")
        ->get();
        return response()->json($gradestudent);

        //GradeStudent::join("grades","grades.id","=","GradeStudent.grade_id")->select("*")->get(); 

    }

    public function store(Request $request){ 
        //validation
        $validate = $request->validate([
            'grade_id' => "required",
            'student_id' => "required"
        ]);

        try{
        $gradestudent = new GradeStudent();
        $gradestudent->grade_id = $request->grade_id;
        $gradestudent->student_id = $request->student_id;       
        $gradestudent->save();
        return response()->json(['message' => 'La clase y el alumno se emprejaron exitosamente']);
    } catch (\Exception $exc) {
        //throw $th;
        return response()->json(['message' => 'Error al emparejar el estuduante con un curso. Debido a: ' . $exc]);
    }
    }

    public function show($id){
        $gradestudent = GradeStudent::find($id);
        return response()->json($gradestudent);
    }
    public function update($id, Request $request){

        $valitaion = $request->validate([
            'grade_id' => "required",
            'student_id' => "required"
        ]);

        try{
            $gradestudent = GradeStudent::find($id);
            $gradestudent->grade_id = $request->grade_id;
            $gradestudent->student_id = $request->student_id;           
            $student->save();
        return response()->json(['message' => 'El registro del curso ' . $gradestudent->grade_id . ' con el estudiante' . $gradestudent->student_id .' fue actualizado correctamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al registrar el curso y el estudiante. Debido a: ' . $exc]);
        }
    }

    public function destroy($id){
        try {
            //code...
            //$student = Student::where('id','=', $id)->first();
            $gradestudent = GradeStudent::find($id);
            $gradestudent->delete();
            return response()->json(['message' => 'El registro se elimino correctamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al eliminar el registro. Debido a: ' . $exc]);
        }

        
    }
}
