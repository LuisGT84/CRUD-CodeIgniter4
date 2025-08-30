<!DOCTYPE html>
<html>
<head>
    <title>Lista de Cursos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS de Materialize -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar simple para navegar entre Alumnos y Cursos -->
    <nav>
      <div class="nav-wrapper teal">
        <a href="<?= site_url('/') ?>" class="brand-logo" style="margin-left:16px">UMG</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="<?= site_url('alumnos') ?>">Alumnos</a></li>
          <li class="active"><a href="<?= site_url('cursos') ?>">Cursos</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <h4><?php echo $titulo ?></h4>

      <!-- Botón "Nuevo Curso"  -->
      <a class="btn waves-effect" href="<?= site_url('cursos/create') ?>">➕ Nuevo Curso</a>

      <table class="striped highlight responsive-table">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Profesor</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>

        <?php foreach ($cursos as $row): ?>
        <tr>
          <td><?= $row['curso'] ?></td>
          <td><?= $row['nombre'] ?></td>
          <td><?= $row['profesor'] ?></td>

          <!-- Estado visual: badge verde Activo / rojo Inactivo -->
          <td>
            <?php if ((int)$row['inactivo'] === 1): ?>
              <span class="new badge red" data-badge-caption="Inactivo"></span>
            <?php else: ?>
              <span class="new badge green" data-badge-caption="Activo"></span>
            <?php endif; ?>
          </td>

          <!-- Acciones-->
          <td>
            <a class="btn-small blue" href="<?= site_url('cursos/edit/' . $row['curso']) ?>">✏️ Editar</a>
            <a class="btn-small red" href="<?= site_url('cursos/delete/' . $row['curso']) ?>"
               onclick="return confirm('¿Seguro que quieres eliminar?')">🗑️ Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <!-- JS de Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
