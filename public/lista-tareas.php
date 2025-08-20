<?php
/**
 * Componente que muestra la lista de tareas
 * Este archivo se incluye en index.php y recibe la variable $tareas
 */
?>

<section class="seccion-tareas">
    <h2>📋 Mis Tareas</h2>
    
    <?php if (empty($tareas)): ?>
        <!-- Mostrar si no hay tareas -->
        <p class="no-tareas">No tienes tareas registradas. ¡Agrega una nueva!</p>
    <?php else: ?>
        <!-- Lista de tareas -->
        <ul class="lista-tareas">
            <?php foreach ($tareas as $tarea): ?>
                <li class="tarea-item">
                    <h3><?= htmlspecialchars($tarea['titulo']) ?></h3>
                    <?php if (!empty($tarea['descripcion'])): ?>
                        <p><?= htmlspecialchars($tarea['descripcion']) ?></p>
                    <?php endif; ?>
                    <small>Creada: <?= date('d/m/Y', strtotime($tarea['fecha_creacion'])) ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>