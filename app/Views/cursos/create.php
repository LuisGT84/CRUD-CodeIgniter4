<!DOCTYPE html>
<html>
<head>
  <title>Nuevo Curso</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
</head>
<body>
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
    <h4>Crear Curso</h4>

    <?php if (!empty($errors)): ?>
      <div class="card red lighten-5">
        <div class="card-content red-text">
          <ul style="margin:0;">
            <?php foreach ($errors as $e): ?>
              <li><?= esc($e) ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('cursos/store') ?>" autocomplete="off">
      <?= csrf_field() ?>

      <div class="input-field">
        <input id="nombre" name="nombre" type="text"
               value="<?= old('nombre', '') ?>">
        <!-- si hay valor en old(), activamos el label para que no se superponga -->
        <label for="nombre" class="<?= old('nombre') !== null && old('nombre') !== '' ? 'active' : '' ?>">
          Nombre del curso
        </label>
      </div>

      <div class="input-field">
        <input id="profesor" name="profesor" type="text"
               value="<?= old('profesor', '') ?>">
        <label for="profesor" class="<?= old('profesor') !== null && old('profesor') !== '' ? 'active' : '' ?>">
          Nombre del profesor
        </label>
      </div>

      <!-- Estado (radios) -->
<div class="section" style="margin-top:8px;">
  <span class="grey-text text-darken-2">Estado</span>
  <p>
    <label>
      <input name="estado" type="radio" value="0" <?= old('estado', '0') === '0' ? 'checked' : '' ?> />
      <span>Activo</span>
    </label>
  </p>
  <p>
    <label>
      <input name="estado" type="radio" value="1" <?= old('estado') === '1' ? 'checked' : '' ?> />
      <span>Inactivo</span>
    </label>
  </p>
</div>


      <button type="submit" class="btn waves-effect">💾 Guardar</button>
      <a href="<?= site_url('cursos') ?>" class="btn-flat">Cancelar</a>
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
