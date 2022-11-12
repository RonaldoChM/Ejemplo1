<html>
    <head>
        <title>Vista Profesor</title>
    </head>
    <body>
        <h1>Lista de profesores</h1>

        <table>
            <tr>
                <td>profesor</td>
                <td>profesion</td>
                <td>grado academico</td>
                <td>celular</td>
            </tr>
            @foreach ($teachers as $teacher)  
            <tr>
                <td>{{$teacher->full_name}}</td>
                <td>{{$teacher->profession}}</td>
                <td>{{$teacher->grade_academy}}</td>
                <td>{{$teacher->cell_phone}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>