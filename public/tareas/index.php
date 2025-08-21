<?php
require_once __DIR__ . '/../../app/database/conexion.php';
require_once __DIR__ . '/../../app/auth/sesion.php';

// Verificar autenticación
requerirAuth();

$usuario_id = $_SESSION['usuario_id'];

// Obtener tareas del usuario
try {
    $stmt = $pdo->prepare("SELECT * FROM tareas WHERE usuario_id = ? ORDER BY fecha_creacion DESC");
    $stmt->execute([$usuario_id]);
    $tareas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al cargar tareas: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Tareas</title>
    <link rel="stylesheet" href="/assets/css/index.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>📝 Mis Tareas</h1>
            <p>Hola, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>!</p>
            <a href="/auth/logout.php" class="logout-sesion">Cerrar sesión</a>
        </header>

        <!-- Formulario para crear tarea -->
        <form action="crear.php" method="POST" class="form-tarea">
            <input type="text" name="titulo" placeholder="Nueva tarea..." required>
            <button type="submit">➕ Agregar</button>
        </form>

        <!-- Lista de tareas -->
        <div class="lista-tareas">
            <?php foreach ($tareas as $tarea): ?>
                <div class="tarea-item <?= $tarea['completada'] ? 'completada' : '' ?>">
                    <h3><?= htmlspecialchars($tarea['titulo']) ?></h3>
                    <?php if (!empty($tarea['descripcion'])): ?>
                        <p><?= htmlspecialchars($tarea['descripcion']) ?></p>
                    <?php endif; ?>
                    
                    <div class="acciones">
                        <!-- Formulario para marcar como completada -->
                        <form action="editar.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                            <input type="hidden" name="completada" value="<?= $tarea['completada'] ? '0' : '1' ?>">
                            <button type="submit"><?= $tarea['completada'] ? '↶ Desmarcar' : '✓ Completar' ?></button>
                        </form>
                        
                        <!-- Botón para editar -->
                        <a href="editar.php?id=<?= $tarea['id'] ?>">✏️ Editar</a>
                        
                        <!-- Formulario para eliminar -->
                        <form action="eliminar.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $tarea['id'] ?>">
                            <button type="submit" onclick="return confirm('¿Eliminar esta tarea?')">🗑️ Eliminar</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>