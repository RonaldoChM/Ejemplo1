<html>
    <head>
        <title>Vista Estudiantes</title>
    </head>
    <body>
        <h1>Lista de Estudiantes</h1>

        <table>
            <tr>
                <td>Nombres</td>
                <td>Apellidos</td>
                <td>Edad</td>
                <td>Celular</td>
                <td>Dirección</td>
            </tr>
            @foreach ($students as $student)  
            <tr>
                <td>{{$student->first_name}}</td>
                <td>{{$student->last_name}}</td>
                <td>{{$student->age}}</td>
                <td>{{$student->cell_phone}}</td>
                <td>{{$student->address}}</td>
            </tr>
            @endforeach
        </table>
    </body>
</html>