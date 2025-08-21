<?php
// Iniciar sesión en todos los archivos que lo incluyan
session_start();

/**
 * Verificar si el usuario está logueado
 * Redirige al login si no está autenticado
 */
function requerirAuth() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: /auth/login.php');
        exit();
    }
}

/**
 * Obtener información del usuario logueado
 */
function obtenerUsuario() {
    return $_SESSION['usuario'] ?? null;
}

/**
 * Verificar si hay un mensaje flash
 */
function tieneMensaje($tipo) {
    return isset($_SESSION['flash'][$tipo]);
}

/**
 * Obtener y limpiar mensaje flash
 */
function obtenerMensaje($tipo) {
    $mensaje = $_SESSION['flash'][$tipo] ?? '';
    unset($_SESSION['flash'][$tipo]);
    return $mensaje;
}
?>