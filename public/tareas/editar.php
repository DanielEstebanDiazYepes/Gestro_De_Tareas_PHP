<?php
require_once __DIR__ . '/../../app/database/conexion.php';
require_once __DIR__ . '/../../app/auth/sesion.php';

requerirAuth();
$usuario_id = $_SESSION['usuario_id'];

// Si viene por GET, mostrar formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $tarea_id = $_GET['id'];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM tareas WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$tarea_id, $usuario_id]);
        $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$tarea) {
            header('Location: index.php');
            exit();
        }
        
        // Mostrar formulario de edición
        include __DIR__ . '/../../app/views/editar-tarea.php';
        exit();
        
    } catch (PDOException $e) {
        header('Location: index.php');
        exit();
    }
}

// Si viene por POST, procesar actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarea_id = $_POST['id'];
    
    // Si es para toggle de completada
    if (isset($_POST['completada'])) {
        $completada = $_POST['completada'];
        try {
            $stmt = $pdo->prepare("UPDATE tareas SET completada = ? WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$completada, $tarea_id, $usuario_id]);
        } catch (PDOException $e) {
            $_SESSION['flash']['error'] = "Error al actualizar tarea";
        }
    } 
    // Si es edición normal
    else {
        $titulo = trim(htmlspecialchars($_POST['titulo']));
        $descripcion = trim(htmlspecialchars($_POST['descripcion'] ?? ''));
        
        try {
            $stmt = $pdo->prepare("UPDATE tareas SET titulo = ?, descripcion = ? WHERE id = ? AND usuario_id = ?");
            $stmt->execute([$titulo, $descripcion, $tarea_id, $usuario_id]);
            $_SESSION['flash']['exito'] = "Tarea actualizada correctamente";
        } catch (PDOException $e) {
            $_SESSION['flash']['error'] = "Error al actualizar tarea";
        }
    }
}

header('Location: index.php');
exit();
?>