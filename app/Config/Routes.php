<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/alumnos', 'AlumnoController::index');
$routes->get('/alumnos/create', 'AlumnoController::create');
$routes->post('/alumnos/store', 'AlumnoController::store');
$routes->get('/alumnos/edit/(:num)', 'AlumnoController::edit/$1');
$routes->post('/alumnos/update/(:num)', 'AlumnoController::update/$1');
$routes->get('/alumnos/delete/(:num)', 'AlumnoController::delete/$1');

/**
 * Asignaciones de cursos a alumnos (modales)
 */
$routes->get('/alumnos/asignar/(:num)', 'AlumnoController::modalAsignar/$1');       // devuelve HTML del modal con checkboxes
$routes->post('/alumnos/asignar/(:num)', 'AlumnoController::guardarAsignacion/$1');  // guarda checkboxes seleccionados
$routes->get('/alumnos/ver-cursos/(:num)', 'AlumnoController::modalVer/$1');         // devuelve HTML del modal de consulta

/**
 * Rutas para curso
 */
$routes->get('/cursos', 'CursoController::index');

// ---- CRUD de Cursos ----
// Formulario de creación
$routes->get('/cursos/create', 'CursoController::create');

// Guardar curso nuevo (POST) - Guardar
$routes->post('/cursos/store', 'CursoController::store');

// Formulario de edición (recibe ID numérico) - Form editar
$routes->get('/cursos/edit/(:num)', 'CursoController::edit/$1');

// Actualizar curso (POST con ID) - Actualizar
$routes->post('/cursos/update/(:num)', 'CursoController::update/$1');

// Eliminar curso (GET con ID) - Eliminar
$routes->get('/cursos/delete/(:num)', 'CursoController::delete/$1');







