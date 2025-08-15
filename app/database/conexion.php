<?php
$host = 'localhost'; // Si usas MySQL Workbench con puerto 3306 (no 3386)
$dbname = 'daniel'; // Nombre correcto de tu DB
$user = 'root';
$password = 'daniel01';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>