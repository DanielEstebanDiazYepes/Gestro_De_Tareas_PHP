<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea - Gestor de Tareas</title>
    <link rel="stylesheet" href="/assets/css/editar.css">
</head>
<body>
    <div class="editar-container">
        <div class="editar-header">
            <h1>✏️ Editar Tarea</h1>
            <p>Modificando tarea de <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></p>
        </div>

        <div class="form-editar">
            <!-- Estado actual de la tarea -->
            <div class="estado-tarea <?= $tarea['completada'] ? 'completada' : '' ?>">
                <div class="checkbox-container">
                    <input type="checkbox" id="estado-actual" <?= $tarea['completada'] ? 'checked' : '' ?> disabled>
                    <label for="estado-actual">
                        <?= $tarea['completada'] ? '✅ Tarea completada' : '⏳ Tarea pendiente' ?>
                    </label>
                </div>
            </div>

            <form action="editar.php" method="POST">
                <input type="hidden" name="id" value="<?= $tarea['id'] ?>">

                <div class="form-group">
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" name="titulo" 
                           value="<?= htmlspecialchars($tarea['titulo']) ?>" 
                           placeholder="Escribe el título aquí..." 
                           required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" 
                              placeholder="Agrega una descripción..."><?= htmlspecialchars($tarea['descripcion'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <div class="checkbox-container">
                        <input type="checkbox" id="completada" name="completada" 
                               value="1" <?= $tarea['completada'] ? 'checked' : '' ?>>
                        <label for="completada">Marcar como completada</label>
                    </div>
                </div>

                <div class="botones-accion">
                    <button type="submit" class="btn-guardar">💾 Guardar Cambios</button>
                    <a href="index.php" class="btn-cancelar">❌ Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('titulo').focus();
            
            document.querySelector('form').addEventListener('submit', function(e) {
                const titulo = document.getElementById('titulo').value.trim();
                
                if (!titulo) {
                    e.preventDefault();
                    alert('El título es obligatorio');
                    document.getElementById('titulo').focus();
                }
            });
        });
    </script>
</body>
</html>