<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AlumnoModel;
use App\Models\CursoModel;
use App\Models\AlumnoCursoModel;

class AlumnoController extends Controller
{
    protected $alumnoModel;       // modelo alumnos
    protected $cursoModel;        // modelo cursos
    protected $alumnoCursoModel;  // modelo detalle alumno-curso

    public function __construct()
    {
        $this->alumnoModel      = new AlumnoModel();      // acceso a alumnos
        $this->cursoModel       = new CursoModel();       // acceso a cursos
        $this->alumnoCursoModel = new AlumnoCursoModel(); // acceso a detalle
        helper(['url', 'form']);                          // helpers de rutas/form
    }

    /** Listado de alumnos con conteo de cursos asignados (para icono). */
    public function index()
    {
        $alumnos = $this->alumnoModel->orderBy('alumno', 'ASC')->findAll();

        // agrega 'asignados' a cada alumno (cantidad de cursos)
        foreach ($alumnos as &$a) {
            $a['asignados'] = $this->alumnoCursoModel->countByAlumno((int)$a['alumno']);
        }

        return view('alumnos/index', [
            'titulo'  => 'Lista de Alumnos',
            'alumnos' => $alumnos,
        ]);
    }

    // Muestra HTML del modal para asignar cursos (checkboxes)
    public function modalAsignar(int $alumnoId)
    {
        $alumno = $this->alumnoModel->find($alumnoId);
        if (!$alumno) { return ''; }

        $todosCursos  = $this->cursoModel->orderBy('nombre', 'ASC')->findAll();
        $asignadosIds = $this->alumnoCursoModel->idsCursosDeAlumno($alumnoId);

        return view('alumnos/_modal_asignar', [
            'alumno'       => $alumno,
            'cursos'       => $todosCursos,
            'asignadosIds' => $asignadosIds,
        ]);
    }

    // Recibe POST del modal y guarda asignaciones de cursos para un alumno
    public function guardarAsignacion(int $alumnoId)
    {
        $cursosIds = (array) $this->request->getPost('cursos'); // puede venir vacío
        $this->alumnoCursoModel->guardarAsignaciones($alumnoId, $cursosIds);
        return redirect()->to(site_url('alumnos')); // vuelve al listado
    }

    // Muestra HTML del modal con cursos asignados (solo lectura)
    public function modalVer(int $alumnoId)
    {
        $alumno = $this->alumnoModel->find($alumnoId);
        if (!$alumno) { return ''; }

        $cursos = $this->alumnoCursoModel->cursosDeAlumno($alumnoId);
        return view('alumnos/_modal_ver', [
            'alumno' => $alumno,
            'cursos' => $cursos,
        ]);
    }

    /* ======== Métodos CRUD de alumnos ======== */

    // Formulario de creación de alumno 
    public function create()
    {
        return view('alumnos/create');
    }

    // Guarda alumno nuevo 
    public function store()
    {
        $this->alumnoModel->insert($this->request->getPost());
        return redirect()->to(site_url('alumnos'));
    }

    // Formulario de edición de alumno 
    public function edit($id)
    {
        $alumno = $this->alumnoModel->find($id);
        if (!$alumno) {
            return redirect()->to(site_url('alumnos'));
        }
        return view('alumnos/edit', ['alumno' => $alumno]);
    }

    // Actualiza alumno 
    public function update($id)
    {
        $this->alumnoModel->update($id, $this->request->getPost());
        return redirect()->to(site_url('alumnos'));
    }

    // Elimina alumno 
    public function delete($id)
    {
        $this->alumnoModel->delete($id);
        return redirect()->to(site_url('alumnos'));
    }
}
