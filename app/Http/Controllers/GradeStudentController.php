<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeStudent;
use Illuminate\Support\Facades\DB;
/* ['grade_id','student_id'] */
class GradeStudentController extends Controller
{
    public function index(){
       
        $gradestudent = DB::table('grade_student as gs')
        ->join("grades as g","g.id","=","gs.grade_id")
        ->join("students as s","s.id","=","gs.student_id")
        ->join("teachers as t", "t.id", "=", "g.teacher_id")
        ->select('gs.id', 'g.name', 's.first_name', 's.last_name')
        //->where('name', 'Fisica')
        ->get();
        return response()->json($gradestudent);

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
        return response()->json(['message' => 'La clase y el alumno se emparejaron exitosamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al emparejar el estuduante con un curso. Debido a: ' . $exc]);
        }
    }

    public function show($id){
        $gradestudent = DB::table('grade_student as gs')
        ->join("grades as g","g.id","=","gs.grade_id")
        ->join("students as s","s.id","=","gs.student_id")
        ->join("teachers as t", "t.id", "=", "g.teacher_id")
        ->select('gs.id', 
        'g.name', 's.first_name', 
        's.last_name', 't.full_name', 
        't.profession', 's.cell_phone as s_phone',
        't.cell_phone as t_phone', 'gs.student_id', 'gs.grade_id')
        ->where('gs.id', $id)
        ->get();
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
            $gradestudent->save();
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
