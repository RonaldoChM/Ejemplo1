<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student; 


//Laravel Lang = traductor de idioma lang/es/validation
class StudentController extends Controller
{
    public function index(){
        $students = Student::all();
        return response()->json($students);
    }

    public function store(Request $request){ 
        //validation
        $validate = $request->validate([
            'first_name' => "required",
            'last_name' => "required",
            "age" => "required|integer",
            "cell_phone" => "required"
        ]);

        try{
        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->age = $request->age;
        $student->cell_phone = $request->cell_phone;
        $student->address = $request->address;
        $student->save();
        return response()->json(['message' => 'El estudiante fue creado exitosamente']);
    } catch (\Exception $exc) {
        //throw $th;
        return response()->json(['message' => 'Error al registrar al estudiante. Debido a: ' . $exc]);
    }
    }

    public function show($id){
        $student = Student::find($id);
        return response()->json($student);
    }
    public function update($id, Request $request){

        $valitaion = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "age" => "required|integer",
            "cell_phone" => "required",
            "address" => "required|string"
        ]);

        try{
            $student = Student::find($id);
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->age = $request->age;
            $student->cell_phone = $request->cell_phone;
            $student->address = $request->address;
            $student->save();
        return response()->json(['message' => 'El registro del estudiante ' . $student->first_name . ' fue actualizado correctamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al registrar al estudiante. Debido a: ' . $exc]);
        }
    }

    public function destroy($id){
        try {
            //code...
            //$student = Student::where('id','=', $id)->first();
            $student = Student::find($id);
            $student->delete();
            return response()->json(['message' => 'El registro se elimino correctamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al eliminar el registro. Debido a: ' . $exc]);
        }

        
    }
}
