<?php
require_once __DIR__ . '/../app/auth/sesion.php';

if (isset($_SESSION['usuario_id'])) {
    header('Location: /tareas/');
} else {
    header('Location: /auth/login.php');
}
exit();
?>