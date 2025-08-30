<!-- Modal para asignar cursos a un alumno (checkboxes) -->
<div class="modal-content">
  <h5>Asignar cursos a: <strong><?= esc($alumno['nombre']) . ' ' . esc($alumno['apellido']) ?></strong></h5>

  <form method="post" action="<?= site_url('alumnos/asignar/' . $alumno['alumno']) ?>">
    <?= csrf_field() ?>

    <?php if (!empty($cursos)): ?>
      <p>Selecciona uno o varios cursos:</p>
      <div class="row">
        <?php foreach ($cursos as $c): ?>
          <div class="col s12 m6">
            <label>
              <input type="checkbox" name="cursos[]"
                     value="<?= $c['curso'] ?>"
                     <?= in_array($c['curso'], $asignadosIds, true) ? 'checked' : '' ?>>
              <span><?= esc($c['nombre']) ?><?= $c['profesor'] ? ' (' . esc($c['profesor']) . ')' : '' ?></span>
            </label>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p>No hay cursos cargados.</p>
    <?php endif; ?>

    <div class="modal-footer" style="margin-top:16px;">
      <button class="modal-close btn waves-effect" type="submit">💾 Guardar</button>
      <a class="modal-close btn-flat">Cancelar</a>
    </div>
  </form>
</div>
