<?php
require_once __DIR__ . '/../../app/auth/sesion.php';

// Destruir sesión
session_destroy();

// Redirigir al login
header('Location: login.php');
exit();
?>