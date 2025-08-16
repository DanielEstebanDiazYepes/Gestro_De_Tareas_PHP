<!DOCTYPE html>
<html lang="es">
<head>
    <title>Gestor de Tareas</title>
</head>
<body>
  <section>
    <h1>Mis Tareas</h1>
      <ul>
        <?php foreach ($tareas as $tarea): ?>
          <li><?= htmlspecialchars($tarea['TITULO']) ?></li>
        <?php endforeach; ?>
      </ul>
  </section>

</body>
</html>