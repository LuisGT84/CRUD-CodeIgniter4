<!DOCTYPE html>
<html>
<head>
    <title>Lista de Alumnos</title>
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
          <li class="active"><a href="<?= site_url('alumnos') ?>">Alumnos</a></li>
          <li><a href="<?= site_url('cursos') ?>">Cursos</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <h4><?php echo $titulo ?></h4>

      <a class="btn waves-effect" href="<?= site_url('alumnos/create') ?>">➕ Nuevo Alumno</a>

      <table class="striped highlight responsive-table">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Movil</th>
          <th>Email</th>
          <th>Acciones</th>
          <th>Asignaciones</th>
        </tr>

        <?php foreach ($alumnos as $row): ?>
        <tr>
          <td><?= $row['alumno'] ?></td>
          <td><?= $row['nombre'] ?></td>
          <td><?= $row['apellido'] ?></td>
          <td><?= $row['movil'] ?></td>
          <td><?= $row['email'] ?></td>

          <!-- Acciones típicas del CRUD (ajusta si tus rutas difieren) -->
          <td>
            <a class="btn-small blue" href="<?= site_url('alumnos/edit/' . $row['alumno']) ?>">✏️ Editar</a>
            <a class="btn-small red" href="<?= site_url('alumnos/delete/' . $row['alumno']) ?>"
               onclick="return confirm('¿Seguro que quieres eliminar?')">🗑️ Eliminar</a>
          </td>

          <!-- Botones de asignación/ver con indicador de color -->
          <td>
            <!-- Verde si tiene asignados, gris si no -->
            <a class="btn-small <?= (int)($row['asignados'] ?? 0) > 0 ? 'green' : 'grey' ?> modal-trigger"
               href="#modal-asignar"
               data-id="<?= $row['alumno'] ?>"
               title="Asignar cursos">🎓 Asignar</a>

            <!-- Ver cursos asignados -->
            <a class="btn-small teal modal-trigger"
               href="#modal-ver"
               data-id="<?= $row['alumno'] ?>"
               title="Ver cursos asignados">👁️ Ver</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </table>
    </div>

    <!-- Contenedores de modales (contenido se carga por AJAX) -->
    <div id="modal-asignar" class="modal"></div>
    <div id="modal-ver" class="modal"></div>

    <!-- JS de Materialize -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
    // Inicializa los modales y maneja la carga dinámica de contenido
    document.addEventListener('DOMContentLoaded', function () {
      M.Modal.init(document.querySelectorAll('.modal'));

      // Abre modal de ASIGNAR y carga HTML por AJAX
      document.body.addEventListener('click', async function (e) {
        const link = e.target.closest('a.modal-trigger[href="#modal-asignar"]');
        if (!link) return;
        const id = link.getAttribute('data-id');
        const res = await fetch('<?= site_url('alumnos/asignar') ?>/' + id);
        document.getElementById('modal-asignar').innerHTML = await res.text();
        M.Modal.getInstance(document.getElementById('modal-asignar')).open();
      });

      // Abre modal de VER y carga HTML por AJAX
      document.body.addEventListener('click', async function (e) {
        const link = e.target.closest('a.modal-trigger[href="#modal-ver"]');
        if (!link) return;
        const id = link.getAttribute('data-id');
        const res = await fetch('<?= site_url('alumnos/ver-cursos') ?>/' + id);
        document.getElementById('modal-ver').innerHTML = await res.text();
        M.Modal.getInstance(document.getElementById('modal-ver')).open();
      });
    });
    </script>
</body>
</html>
