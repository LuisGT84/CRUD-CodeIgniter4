<?php
namespace App\Controllers;

use App\Models\CursoModel;
use CodeIgniter\Controller;

/**
 * Controlador de Cursos (CRUD).
 * Gestiona listado, creación, edición y eliminación de cursos.
 */
class CursoController extends Controller
{
    protected $cursoModel; // acceso al modelo de cursos

    public function __construct()
    {
        $this->cursoModel = new CursoModel(); // instancia del modelo
        helper(['url', 'form']);              // helpers de rutas y formularios
    }

    /** Muestra el listado de cursos. */
    public function index()
    {
        $data = [
            'titulo' => 'Lista de Cursos',
            'cursos' => $this->cursoModel->orderBy('curso', 'ASC')->findAll(),
        ];
        return view('cursos/index', $data);
    }

    /** Muestra formulario de creación. */
    public function create()
    {
        return view('cursos/create');
    }

    /** Guarda un curso nuevo. */
    public function store()
    {
        $this->cursoModel->insert([
            'nombre'   => $this->request->getPost('nombre'),
            'profesor' => $this->request->getPost('profesor'),
            'inactivo' => $this->request->getPost('inactivo') ? 1 : 0,
        ]);
        return redirect()->to(site_url('cursos'));
    }

    /** Muestra formulario de edición. */
    public function edit($id)
    {
        $curso = $this->cursoModel->find($id);
        if (!$curso) {
            return redirect()->to(site_url('cursos'));
        }
        return view('cursos/edit', ['curso' => $curso]);
    }

    /** Actualiza los datos de un curso. */
    public function update($id)
    {
        $this->cursoModel->update($id, [
            'nombre'   => $this->request->getPost('nombre'),
            'profesor' => $this->request->getPost('profesor'),
            'inactivo' => $this->request->getPost('inactivo') ? 1 : 0,
        ]);
        return redirect()->to(site_url('cursos'));
    }

    /** Elimina un curso. */
    public function delete($id)
    {
        $this->cursoModel->delete($id);
        return redirect()->to(site_url('cursos'));
    }
}