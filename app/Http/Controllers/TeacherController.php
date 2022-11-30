<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{

    public function index()
    {
        $teacher = Teacher::all();
        return response()->json($teacher);
        /*$teacher = Teacher::all();
        return view('teachers.index',['teachers' => $teacher]);*/
    }

   
    public function create()
    {
       // return view('teachers.create');
    }

   
    public function store(Request $request)
    {
        /* 
           $table->id();
            $table->string('full_name');
            $table->string('profession');
            $table->integer('grade_academy');
            $table->string('cell_phone'); 
        */
        $validate = $request->validate([
            'full_name' => "required",
            'profession' => "required",
            "grade_academy" => "required",
            "cell_phone" => "required"
        ]);

        try{
            $teacher = new Teacher();
            $teacher->full_name = $request->full_name;
            $teacher->profession = $request->profession;
            $teacher->grade_academy = $request->grade_academy;
            $teacher->cell_phone = $request->cell_phone;
            $teacher->save();
            return response()->json(['message' => 'El Profesor fue creado exitosamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al registrar al Profesor. Debido a: ' . $exc]);
        }
    }

    public function show($id)
    {
        $teacher = Teacher::find($id);
        return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

 
    public function update(Request $request, $id)
    {       
         /* 
           $table->id();
            $table->string('full_name');
            $table->string('profession');
            $table->integer('grade_academy');
            $table->string('cell_phone'); 
        */
        $valitaion = $request->validate([
            "full_name" => "required",
            "profession" => "required",
            "grade_academy" => "required",
            "cell_phone" => "required",
        ]);

        try{
            $teacher = Teacher::find($id);
            $teacher->full_name = $request->full_name;
            $teacher->profession = $request->profession;
            $teacher->grade_academy = $request->grade_academy;
            $teacher->cell_phone = $request->cell_phone;
            $teacher->save();
        return response()->json(['message' => 'El registro del profesor ' . $teacher->full_name . ' fue actualizado correctamente']);
        } catch (\Exception $exc) {
            //throw $th;
            return response()->json(['message' => 'Error al registrar al profesor. Debido a: ' . $exc]);
        }
    }

    public function destroy($id)
    {
        try {
            $teacher = Teacher::find($id);
            $teacher->delete();
            return response()->json(['message' => 'El registro se elimino correctamente']);
        } catch (\Exception $exc) {

            return response()->json(['message' => 'Error al eliminar el registro. Debido a: ' . $exc]);
        }
    }
}
