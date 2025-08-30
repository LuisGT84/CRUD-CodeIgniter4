<!-- Modal para visualizar los cursos asignados de un alumno -->
<div class="modal-content">
  <h5>Cursos asignados a <strong><?= esc($alumno['nombre']) . ' ' . esc($alumno['apellido']) ?></strong></h5>

  <?php if (!empty($cursos)): ?>
    <ul class="collection">
      <?php foreach ($cursos as $c): ?>
        <li class="collection-item">
          <?= esc($c['nombre']) ?>
          <?= $c['profesor'] ? '<span class="grey-text"> — ' . esc($c['profesor']) . '</span>' : '' ?>
          <?php if ((int)$c['inactivo'] === 1): ?>
            <span class="new badge red" data-badge-caption="Inactivo"></span>
          <?php else: ?>
            <span class="new badge green" data-badge-caption="Activo"></span>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p>No tiene cursos asignados.</p>
  <?php endif; ?>

  <div class="modal-footer">
    <a class="modal-close btn-flat">Cerrar</a>
  </div>
</div>
