<html>
    <head>
        <title>Vista Profesor</title>
    </head>
    <body>
        <h1>Crear nuevo profesores</h1>
    <form action="{{route('teachers.store')}}" method="POST">
        @csrf
        <label>Nombre</label>
        <input type="text" name="full_name">
        <br/>
        <label>Profesion</label>
        <input type="text" name="profession">
        <br/>
        <label>Grado Academico</label>
        <input type="text" name="grade_academy">
        <br/>
        <label>Celular</label>
        <input type="text" name="cell_phone">
        <br/>
        <button type="submit">Guardar</button>
    </form>
        
    </body>
</html>