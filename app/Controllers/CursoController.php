<?php

namespace App\Controllers;

use App\Models\CursoModel;
use CodeIgniter\Controller;

/**
 * Controlador de Cursos
 * - index(): Listado de cursos
 * - create(): Formulario de alta
 * - store(): Inserta un curso nuevo
 * - edit($id): Formulario de edición
 * - update($id): Actualiza un curso existente
 * - delete($id): Elimina un curso
 */
class CursoController extends Controller
{
    protected $cursoModel;

    public function __construct()
    {
        // Instancia el modelo una sola vez para usarlo en todos los métodos
        $this->cursoModel = new CursoModel();

        // Helpers para URLs y formularios (site_url(), csrf_field(), etc.)
        helper(['url', 'form']);
    }

    /**
     * GET /cursos
     * Muestra el listado de cursos
     */
    public function index()
    {
        $data['cursos'] = $this->cursoModel->orderBy('curso', 'ASC')->findAll();
        $data['titulo'] = "Listado de cursos";
        return view('cursos/index', $data);
    }

    /**
     * GET /cursos/create
     * Muestra el formulario para crear un curso
     */
    public function create()
    {
        return view('cursos/create');
    }

    /**
     * POST /cursos/store
     * Inserta el curso enviado desde el formulario de alta
     */
    public function store()
    {
        $this->cursoModel->insert([
            'nombre'   => $this->request->getPost('nombre'),
            'profesor' => $this->request->getPost('profesor'),
            // si el checkbox viene tildado => 1, si no => 0
            'inactivo' => $this->request->getPost('inactivo') ? 1 : 0,
        ]);

        return redirect()->to(site_url('cursos'));
    }

    /**
     * GET /cursos/edit/{id}
     * Muestra el formulario para editar un curso existente
     */
    public function edit($id)
    {
        $curso = $this->cursoModel->find($id);
        if (!$curso) {
            // Si no existe el ID, volvemos al listado
            return redirect()->to(site_url('cursos'));
        }

        return view('cursos/edit', ['curso' => $curso]);
    }

    /**
     * POST /cursos/update/{id}
     * Actualiza los datos del curso
     */
    public function update($id)
    {
        $this->cursoModel->update($id, [
            'nombre'   => $this->request->getPost('nombre'),
            'profesor' => $this->request->getPost('profesor'),
            'inactivo' => $this->request->getPost('inactivo') ? 1 : 0,
        ]);

        return redirect()->to(site_url('cursos'));
    }

    /**
     * GET /cursos/delete/{id}
     * Elimina un curso por ID
     */
    public function delete($id)
    {
        $this->cursoModel->delete($id);
        return redirect()->to(site_url('cursos'));
    }
}
    