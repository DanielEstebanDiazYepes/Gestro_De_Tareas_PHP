<?php
require_once __DIR__ . '/../../app/database/conexion.php';
require_once __DIR__ . '/../../app/auth/sesion.php';

// Si ya está logueado, redirigir a tareas
if (isset($_SESSION['usuario_id'])) {
    header('Location: /tareas/');
    exit();
}

$errores = [];
$email = '';

// Procesar formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validaciones básicas
    if (empty($email) || empty($password)) {
        $errores[] = "Email y contraseña son obligatorios";
    } else {
        try {
            // Buscar usuario en la base de datos
            $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verificar credenciales
            if ($usuario && password_verify($password, $usuario['password'])) {
                // Iniciar sesión exitosamente
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'email' => $usuario['email']
                ];
                
                // Redirigir al dashboard de tareas
                header('Location: /tareas/');
                exit();
            } else {
                $errores[] = "Credenciales incorrectas";
            }
        } catch (PDOException $e) {
            $errores[] = "Error al iniciar sesión. Intenta nuevamente.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Gestor de Tareas</title>
    <link rel="stylesheet" href="/assets/css/auth.css">
</head>
<body>
    <div class="auth-container">
        <h2>Iniciar Sesión</h2>
        
        <!-- Mostrar mensajes de éxito (si vienes del registro) -->
        <?php if (isset($_SESSION['flash']['exito'])): ?>
            <div class="mensaje-exito">
                <?= htmlspecialchars($_SESSION['flash']['exito']) ?>
                <?php unset($_SESSION['flash']['exito']); ?>
            </div>
        <?php endif; ?>

        <!-- Mostrar errores -->
        <?php if (!empty($errores)): ?>
            <div class="errores">
                <?php foreach ($errores as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required 
                       value="<?= htmlspecialchars($email) ?>"
                       placeholder="tu@email.com">
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required 
                       placeholder="••••••••">
            </div>
            
            <button type="submit">Iniciar Sesión</button>
        </form>

        <div class="auth-footer">
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
        </div>
    </div>

    <script> //SCRIP PARA QUE EL FOCO INICIAL SEA EN EMAIL
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
    </script>
</body>
</html>