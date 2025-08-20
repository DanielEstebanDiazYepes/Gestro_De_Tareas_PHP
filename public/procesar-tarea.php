<?php
/**
 * Procesa el formulario de nueva tarea
 * Recibe los datos por POST y los guarda en la base de datos
 */

// Incluir conexión a BD
require_once __DIR__ . '/../app/database/conexion.php';

// Verificar que se envió el formulario (método POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Obtener y limpiar los datos del formulario
    $titulo = trim(htmlspecialchars($_POST['titulo']));
    $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ''));
    
    // Validar que el título no esté vacío
    if (empty($titulo)) {
        die("El título es obligatorio");
    }
    
    try {
        // Preparar consulta SQL con parámetros (evita inyecciones SQL)
        $sql = "INSERT INTO tareas (titulo, descripcion) VALUES (:titulo, :descripcion)";
        $stmt = $pdo->prepare($sql);
        
        // Ejecutar consulta con los valores del formulario
        $stmt->execute([
            ':titulo' => $titulo,
            ':descripcion' => $descripcion
        ]);
        
        // Redirigir a la página principal con mensaje de éxito
        header('Location: index.php?exito=1');
        exit();
        
    } catch (PDOException $e) {
        die("Error al guardar la tarea: " . $e->getMessage());
    }
    
} else {
    // Si alguien intenta acceder directamente a este archivo, redirigir
    header('Location: index.php');
    exit();
}
?>