<?php
require_once __DIR__ . '/../app/database/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nueva Tarea</title>

    <link rel="stylesheet" href="/assets/css/index.css">

</head>
<body>
    <h1>Agregar Nueva Tarea</h1>
    
    <form action="procesar-tarea.php" method="POST">

        <div class="form-group">
            <label for="titulo">usuario_ID</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        
        <button type="submit">Guardar Tarea</button>
    </form>
    
</body>
</html>