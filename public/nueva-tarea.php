<?php
require_once __DIR__ . '/../app/database/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Nueva Tarea</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], textarea { 
            width: 100%; 
            padding: 8px; 
            border: 1px solid #ddd; 
            border-radius: 4px;
        }
        button { 
            background-color: #4CAF50; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer;
        }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <h1>Agregar Nueva Tarea</h1>
    
    <form action="procesar-tarea.php" method="POST">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4"></textarea>
        </div>
        
        <button type="submit">Guardar Tarea</button>
    </form>
    
    <p><a href="index.php">← Volver al listado</a></p>
</body>
</html>