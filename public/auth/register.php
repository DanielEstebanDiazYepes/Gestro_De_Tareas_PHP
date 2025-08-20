<?php
require_once __DIR__ . '/../../app/database/conexion.php';
require_once __DIR__ . '/../../app/auth/sesion.php';

// Si ya está logueado, redirigir a tareas
if (isset($_SESSION['usuario_id'])) {
    header('Location: /tareas/');
    exit();
}

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validaciones
    if (empty($nombre)) $errores[] = "El nombre es obligatorio";
    if (empty($email)) $errores[] = "El email es obligatorio";
    if (empty($password)) $errores[] = "La contraseña es obligatoria";
    if ($password !== $confirm_password) $errores[] = "Las contraseñas no coinciden";

    if (empty($errores)) {
        try {
            // Verificar si el email ya existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $errores[] = "El email ya está registrado";
            } else {
                // Hash de contraseña
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                
                // Insertar nuevo usuario
                $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$nombre, $email, $password_hash]);
                
                $_SESSION['flash']['exito'] = "¡Registro exitoso! Ahora puedes iniciar sesión";
                header('Location: login.php');
                exit();
            }
        } catch (PDOException $e) {
            $errores[] = "Error en el registro: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - Gestor de Tareas</title>
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <h2>📝 Registrarse</h2>
        
        <?php if (!empty($errores)): ?>
            <div class="errores">
                <?php foreach ($errores as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" required value="<?= htmlspecialchars($nombre ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label>Confirmar Contraseña:</label>
                <input type="password" name="confirm_password" required>
            </div>
            
            <button type="submit">Registrarse</button>
        </form>
        
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>