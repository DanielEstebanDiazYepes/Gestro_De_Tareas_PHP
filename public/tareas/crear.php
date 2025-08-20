<?php
require_once __DIR__ . '/../../app/database/conexion.php';
require_once __DIR__ . '/../../app/auth/sesion.php';

requerirAuth();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim(htmlspecialchars($_POST['titulo']));
    $usuario_id = $_SESSION['usuario_id'];

    if (!empty($titulo)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO tareas (usuario_id, titulo) VALUES (?, ?)");
            $stmt->execute([$usuario_id, $titulo]);
        } catch (PDOException $e) {
            $_SESSION['flash']['error'] = "Error al crear tarea";
        }
    }
}

header('Location: index.php');
exit();
?>