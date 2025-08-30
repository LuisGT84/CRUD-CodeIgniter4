<?php
namespace App\Models;

use CodeIgniter\Model;

/**
 * Modelo de la tabla detalle_alumno_curso (relación N:N).
 * Provee utilidades para listar, contar y guardar asignaciones de cursos por alumno.
 */
class AlumnoCursoModel extends Model
{
    protected $table         = 'detalle_alumno_curso'; // tabla detalle
    protected $primaryKey    = 'id';                   // PK de la tabla detalle
    protected $returnType    = 'array';                // resultados como arreglo
    protected $allowedFields = ['alumno', 'curso'];    // columnas permitidas

    // Retorna los IDs de cursos asignados a un alumno
    public function idsCursosDeAlumno(int $alumnoId): array
    {
        return array_column(
            $this->select('curso')->where('alumno', $alumnoId)->findAll(),
            'curso'
        );
    }

    // Retorna los cursos asignados a un alumno
    public function cursosDeAlumno(int $alumnoId): array
    {
        return $this->db->table('detalle_alumno_curso d')
            ->select('c.curso, c.nombre, c.profesor, c.inactivo')
            ->join('cursos c', 'c.curso = d.curso')
            ->where('d.alumno', $alumnoId)
            ->orderBy('c.nombre', 'ASC')
            ->get()->getResultArray();
    }

    // Retorna cuántos cursos tiene asignado un alumno
    public function countByAlumno(int $alumnoId): int
    {
        return (int) $this->where('alumno', $alumnoId)->countAllResults();
    }

    /**
     * Guarda las asignaciones de cursos para un alumno
     * @param int   $alumnoId   ID de alumno
     * @param int[] $cursosIds  IDs de cursos seleccionados
     */
    public function guardarAsignaciones(int $alumnoId, array $cursosIds): void
    {
        $this->where('alumno', $alumnoId)->delete(); // elimina asignaciones actuales
        $filas = array_map(fn($cid) => ['alumno' => $alumnoId, 'curso' => (int)$cid], array_unique($cursosIds));
        if (!empty($filas)) {
            $this->insertBatch($filas); // inserta nuevas asignaciones
        }
    }
}