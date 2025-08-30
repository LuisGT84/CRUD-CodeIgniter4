<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<nav>
  <div class="nav-wrapper teal">
    <a href="#" class="brand-logo" style="margin-left:16px">UMG</a>
    <ul class="right hide-on-med-and-down">
      <li><a href="<?= site_url('alumnos') ?>">Alumnos</a></li>
      <li class="active"><a href="<?= site_url('cursos') ?>">Cursos</a></li>
    </ul>
  </div>
</nav>

<div class="container" style="margin-top:24px">
  <h4>Editar Curso</h4>
  <form method="post" action="<?= site_url('cursos/update/' . $curso['curso']) ?>">
    <?= csrf_field() ?>
    <div class="input-field">
      <input id="nombre" name="nombre" value="<?= esc($curso['nombre']) ?>" required>
      <label class="active" for="nombre">Nombre del curso</label>
    </div>
    <div class="input-field">
      <input id="profesor" name="profesor" value="<?= esc($curso['profesor']) ?>">
      <label class="active" for="profesor">Profesor</label>
    </div>
    <p><label><input type="checkbox" name="inactivo" value="1" <?= (int)$curso['inactivo']===1?'checked':'' ?>><span>Inactivo</span></label></p>
    <button class="btn waves-effect waves-light" type="submit"><i class="material-icons left">save</i>Actualizar</button>
    <a class="btn-flat" href="<?= site_url('cursos') ?>"><i class="material-icons left">arrow_back</i>Volver</a>
  </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
