<?php

namespace App\Models;

use CodeIgniter\Model;

class HorarioModel extends Model
{
    protected $table         = 'academia_horarios';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'academia_id',
        'dia_semana',
        'hora_inicio',
        'hora_fin',
    ];

    // Sin timestamps — la tabla no tiene created_at / updated_at
    protected $useTimestamps = false;


    // ================================================================
    // MÉTODO 1 — Horarios de una academia
    // ================================================================
    // Retorna todos los horarios de una academia ordenados por día y hora.
    //
    // Uso:
    //   $horarios = $this->horarioModel->getPorAcademia($academiaId);
    // ================================================================
    public function getPorAcademia(int $academiaId): array
    {
        return $this->where('academia_id', $academiaId)
            ->orderBy('dia_semana', 'ASC')
            ->orderBy('hora_inicio', 'ASC')
            ->findAll();
    }


    // ================================================================
    // MÉTODO 2 — Reemplazar todos los horarios de una academia
    // ================================================================
    // Elimina los horarios existentes e inserta los nuevos.
    // Es el enfoque más simple y seguro al editar una academia:
    // no hay que comparar qué cambió, simplemente se reemplaza todo.
    //
    // $horarios debe ser el array que viene del formulario:
    //   [
    //     ['dia_semana' => 1, 'hora_inicio' => '15:00', 'hora_fin' => '16:30'],
    //     ['dia_semana' => 3, 'hora_inicio' => '15:00', 'hora_fin' => '16:30'],
    //   ]
    //
    // Uso:
    //   $this->horarioModel->reemplazar($academiaId, $request->getPost('horarios'));
    // ================================================================
    public function reemplazar(int $academiaId, array $horarios): bool
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // Eliminar los horarios actuales
        $this->where('academia_id', $academiaId)->delete();

        // Preparar e insertar los nuevos
        $nuevos = [];
        foreach ($horarios as $h) {
            // Ignorar filas incompletas que puedan venir del form
            if (empty($h['dia_semana']) || empty($h['hora_inicio']) || empty($h['hora_fin'])) {
                continue;
            }
            $nuevos[] = [
                'academia_id' => $academiaId,
                'dia_semana'  => (int) $h['dia_semana'],
                'hora_inicio' => $h['hora_inicio'],
                'hora_fin'    => $h['hora_fin'],
            ];
        }

        if (!empty($nuevos)) {
            $this->insertBatch($nuevos);
        }

        $db->transComplete();

        return $db->transStatus();
    }


    // ================================================================
    // MÉTODO 3 — Academias programadas para un día específico
    // ================================================================
    // Útil para el dashboard del profesor y para las stats.
    // Retorna los horarios (con id de academia) que corresponden
    // al día indicado. $dia usa el mismo criterio: 1=Lunes ... 5=Viernes.
    //
    // Uso (clases de hoy):
    //   $hoy = (int) date('N');
    //   $horarios = $this->horarioModel->getPorDia($hoy);
    //
    // Uso (clases de un día específico):
    //   $horarios = $this->horarioModel->getPorDia(3); // Miércoles
    // ================================================================
    public function getPorDia(int $dia): array
    {
        return $this->where('dia_semana', $dia)
            ->orderBy('hora_inicio', 'ASC')
            ->findAll();
    }
}
