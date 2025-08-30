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
  <h4>Nuevo Curso</h4>
  <form method="post" action="<?= site_url('cursos/store') ?>">
    <?= csrf_field() ?>
    <div class="input-field">
      <input id="nombre" name="nombre" required>
      <label for="nombre">Nombre del curso</label>
    </div>
    <div class="input-field">
      <input id="profesor" name="profesor">
      <label for="profesor">Profesor</label>
    </div>
    <p><label><input type="checkbox" name="inactivo" value="1"><span>Inactivo</span></label></p>
    <button class="btn waves-effect waves-light" type="submit"><i class="material-icons left">save</i>Guardar</button>
    <a class="btn-flat" href="<?= site_url('cursos') ?>"><i class="material-icons left">arrow_back</i>Volver</a>
  </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
