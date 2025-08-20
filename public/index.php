<?php
/**
 * Página principal - Lista todas las tareas
 * Este es el archivo que se carga cuando entras al sitio
 */

// Incluir la conexión a la base de datos
require_once __DIR__ . '/../app/database/conexion.php';

// Verificar si la conexión se creó correctamente
if (!isset($pdo)) {
    die("Error: No se pudo conectar a la base de datos");
}

// Obtener todas las tareas de la base de datos
try {
    // Preparar y ejecutar consulta SQL
    $stmt = $pdo->query("SELECT * FROM tareas ORDER BY fecha_creacion DESC");
    // Obtener todos los resultados como array asociativo
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    die("Error al cargar tareas: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Tareas</title>
    <link rel="stylesheet" href="/assets/css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📝 Gestor de Tareas</h1>
        </header>
        
        <main>
            <!-- Incluir el archivo que muestra la lista de tareas -->
            <?php include __DIR__ . '/lista-tareas.php'; ?>
            
            <!-- Incluir el formulario para agregar nuevas tareas -->
            <?php include __DIR__ . '/nueva-tarea.php'; ?>
        </main>
    </div>
</body>
</html>