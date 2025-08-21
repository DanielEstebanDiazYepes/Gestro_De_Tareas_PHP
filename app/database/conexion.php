<?php

// Configuración de la base de datos - CAMBIA ESTOS VALORES POR LOS TUYOS
$host = 'localhost';      // Servidor de base de datos
$dbname = 'daniel'; // Nombre de tu base de datos
$user = 'root';           // Usuario de MySQL
$password = 'daniel01'; // Contraseña de MySQL

try {
    // Crear conexión usando PDO (más seguro que mysql_*)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Configurar para que muestre errores (útil durante desarrollo)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Usar UTF-8 para caracteres especiales (tildes, ñ, etc.)
    $pdo->exec("SET NAMES 'utf8'");
    
} catch (PDOException $e) {
    // Si hay error en la conexión, mostrar mensaje y detener ejecución
    die("Error de conexión: " . $e->getMessage());
}
?>