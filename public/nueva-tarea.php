<?php
/**
 * Formulario para agregar nuevas tareas
 * Los datos se envían a procesar-tarea.php
 */
?>

<section class="seccion-formulario">
    <h2>➕ Nueva Tarea</h2>
    
    <form action="procesar-tarea.php" method="POST" class="form-tarea">
        <div class="grupo-form">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required 
                   placeholder="Ej: Comprar leche">
        </div>
        
        <div class="grupo-form">
            <label for="descripcion">Descripción (opcional):</label>
            <textarea id="descripcion" name="descripcion" 
                      placeholder="Detalles de la tarea..."></textarea>
        </div>
        
        <button type="submit" class="btn-guardar">💾 Guardar Tarea</button>
    </form>
</section>