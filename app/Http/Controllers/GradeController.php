<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Teacher;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$grade = Grade::all();
        //$grade = Teacher::select("*")->join("grades","teachers.id","=","grades.teacher_id")->get();
        $grade = Teacher::join('grades','teachers.id', '=', 'grades.teacher_id')
        ->select('grades.id', 'grades.name','grades.level','grades.hours', 'teachers.full_name')->get();
        return response()->json($grade);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'name' => "required",
            'level' => "required",
            "hours" => "required",
            "teacher_id" => "required"
        ]);

        try{
            $grade = new Grade();
            $grade->name = $request->name;
            $grade->level = $request->level;
            $grade->hours = $request->hours;
            $grade->teacher_id = $request->teacher_id;
            $grade->save();
            return response()->json(['message' => 'El Grado fue creado exitosamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al registrar el grado. Debido a: ' . $exc]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$grade = Grade::find($id);
       //$grade = Teacher::select("*")->join("grades","teachers.id","=","grades.teacher_id")->find($id);
       /*$grade = Teacher::join('grades','teachers.id', '=', 'grades.teacher_id')
        ->select('grades.id as gradeid', 'grades.name','grades.level','grades.hours', 'teachers.full_name')->find($id);*/
        $grade = Grade::join('teachers','grades.teacher_id', '=', 'teachers.id')
        ->select('grades.id', 'grades.name','grades.level','grades.hours','grades.teacher_id', 'teachers.full_name')->find($id);
        return response()->json($grade);
    }

  
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {

        $valitaion = $request->validate([
            "name" => "required",
            "level" => "required",
            "hours" => "required",
            "teacher_id" => "required",
        ]);

        try{
            $grade = Grade::find($id);
            /*$grade = Grade::join('teachers','grades.teacher_id', '=', 'teachers.id')
            ->select('grades.id as gradeid', 'grades.name','grades.level','grades.hours','grades.teacher_id')
            ->find($id);*/
            $grade->name = $request->name;
            $grade->level = $request->level;
            $grade->hours = $request->hours;
            $grade->teacher_id = $request->teacher_id;
            $grade->save();
        return response()->json(['message' => 'El registro del grado ' . $grade->name . ' fue actualizado correctamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al registrar el grado. Debido a: ' . $exc]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //code...
            //$student = Student::where('id','=', $id)->first();
            $grade = Grade::find($id);
            $grade->delete();
            return response()->json(['message' => 'El registro se elimino correctamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al eliminar el registro. Debido a: ' . $exc]);
        }
    }
}
