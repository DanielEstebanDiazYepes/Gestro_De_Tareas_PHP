<?php
require_once __DIR__ . '/../../app/database/conexion.php';
require_once __DIR__ . '/../../app/auth/sesion.php';

requerirAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $tarea_id = $_POST['id'];
    $usuario_id = $_SESSION['usuario_id'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM tareas WHERE id = ? AND usuario_id = ?");
        $stmt->execute([$tarea_id, $usuario_id]);
        $_SESSION['flash']['exito'] = "Tarea eliminada correctamente";
    } catch (PDOException $e) {
        $_SESSION['flash']['error'] = "Error al eliminar tarea";
    }
}

header('Location: index.php');
exit();
?>