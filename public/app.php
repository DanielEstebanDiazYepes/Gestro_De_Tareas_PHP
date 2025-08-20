
<?php

var_dump("Ejecutando consulta..."); // Agrega esta línea para depurar


// Verifica si la conexión existe
if (!isset($pdo)) { 
    die("Error: No se pudo establecer conexión a la base de datos");
}

$stmt = $pdo->query("SELECT * FROM tareas");
$tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<?php

?>
