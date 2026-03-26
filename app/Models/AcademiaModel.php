<?php

namespace App\Models;

use CodeIgniter\Model;

class AcademiaModel extends Model
{
    protected $table         = 'academias';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nombre',
        'descripcion',
        'sala',
        'cupos',
        'activa',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // ================================================================
    // MÉTODO 1 — Lista completa de academias con horarios,
    //            profesor y cantidad de alumnos inscritos
    // ================================================================
    // Retorna un array de academias. Cada academia incluye:
    //   - todos los campos de `academias`
    //   - 'horarios'  => array de rows de academia_horarios
    //   - 'profesor'  => nombre completo del profesor (o null)
    //   - 'alumnos'   => (int) cantidad de alumnos inscritos
    //
    // Uso en el controlador:
    //   $academias = $this->academiaModel->getLista();
    // ================================================================
    public function getLista(): array
    {
        $db = \Config\Database::connect();

        // 1. Academias con conteo de alumnos y datos del profesor
        //    LEFT JOIN academia_profesor y users para el nombre del profesor
        //    LEFT JOIN academia_alumno para el conteo
        $academias = $db->table('academias a')
            ->select([
                'a.id',
                'a.nombre',
                'a.descripcion',
                'a.sala',
                'a.cupos',
                'a.activa',
                'a.created_at',
                // Nombre del profesor (NULL si no tiene asignado)
                "CONCAT(u.first_name, ' ', u.last_name) AS profesor",
                // Conteo de alumnos inscritos
                'COUNT(DISTINCT aa.alumno_id) AS alumnos',
            ])
            ->join('academia_profesor ap', 'ap.academia_id = a.id', 'left')
            ->join('users u',             'u.id = ap.user_id',      'left')
            ->join('academia_alumno aa',  'aa.academia_id = a.id',  'left')
            ->groupBy('a.id, u.id')
            ->orderBy('a.nombre', 'ASC')
            ->get()
            ->getResultArray();

        if (empty($academias)) {
            return [];
        }

        // 2. Traer todos los horarios de una sola query (evita N+1)
        $ids      = array_column($academias, 'id');
        $horarios = $db->table('academia_horarios')
            ->whereIn('academia_id', $ids)
            ->orderBy('dia_semana', 'ASC')
            ->orderBy('hora_inicio', 'ASC')
            ->get()
            ->getResultArray();

        // Indexar horarios por academia_id para asignación rápida
        $horariosPorAcademia = [];
        foreach ($horarios as $h) {
            $horariosPorAcademia[$h['academia_id']][] = $h;
        }

        // 3. Combinar
        foreach ($academias as &$academia) {
            $academia['horarios'] = $horariosPorAcademia[$academia['id']] ?? [];
            // Castear tipos
            $academia['alumnos'] = (int) $academia['alumnos'];
            $academia['cupos']   = (int) $academia['cupos'];
        }
        unset($academia);

        return $academias;
    }


    // ================================================================
    // MÉTODO 2 — Una sola academia con los mismos datos
    // ================================================================
    // Retorna array con la academia o null si no existe.
    //
    // Uso en el controlador:
    //   $academia = $this->academiaModel->getConDetalle($id);
    //   if (!$academia) { throw new \CodeIgniter\Exceptions\PageNotFoundException(); }
    // ================================================================
    public function getConDetalle(int $id): ?array
    {
        $db = \Config\Database::connect();

        $academia = $db->table('academias a')
            ->select([
                'a.id',
                'a.nombre',
                'a.descripcion',
                'a.sala',
                'a.cupos',
                'a.activa',
                'a.created_at',
                'a.updated_at',
                "CONCAT(u.first_name, ' ', u.last_name) AS profesor",
                'u.id AS profesor_id',
                'COUNT(DISTINCT aa.alumno_id) AS alumnos',
            ])
            ->join('academia_profesor ap', 'ap.academia_id = a.id', 'left')
            ->join('users u',             'u.id = ap.user_id',      'left')
            ->join('academia_alumno aa',  'aa.academia_id = a.id',  'left')
            ->where('a.id', $id)
            ->groupBy('a.id, u.id')
            ->get()
            ->getRowArray();

        if (!$academia) {
            return null;
        }

        // Horarios de esta academia
        $academia['horarios'] = $db->table('academia_horarios')
            ->where('academia_id', $id)
            ->orderBy('dia_semana', 'ASC')
            ->orderBy('hora_inicio', 'ASC')
            ->get()
            ->getResultArray();

        // Castear tipos
        $academia['alumnos']     = (int) $academia['alumnos'];
        $academia['cupos']       = (int) $academia['cupos'];
        $academia['profesor_id'] = $academia['profesor_id']
            ? (int) $academia['profesor_id']
            : null;

        return $academia;
    }


    // ================================================================
    // MÉTODO 3 — Estadísticas generales del módulo academias
    // ================================================================
    // Retorna un array con las siguientes claves:
    //
    //   total           => int  — total de academias registradas
    //   activas         => int  — academias con activa = 1
    //   inactivas       => int  — academias con activa = 0
    //   activas_hoy     => int  — academias con clase el día de hoy
    //                             (basado en academia_horarios.dia_semana)
    //   total_alumnos   => int  — alumnos inscritos en al menos una academia activa
    //                             (COUNT DISTINCT para no duplicar)
    //   sin_profesor    => int  — academias activas sin profesor asignado
    //
    // Uso en el controlador:
    //   $stats = $this->academiaModel->getStats();
    // ================================================================
    public function getStats(): array
    {
        $db = \Config\Database::connect();

        // Número de día actual: DAYOFWEEK en MySQL devuelve 1=Dom ... 7=Sáb
        // Nuestro esquema usa 1=Lun ... 5=Vie, así que convertimos
        // DAYOFWEEK: 2=Lun, 3=Mar, 4=Mié, 5=Jue, 6=Vie → restamos 1
        // Usamos PHP para mayor portabilidad entre MySQL/MariaDB
        $diaHoy = (int) date('N'); // 1=Lunes ... 7=Domingo (ISO-8601)

        // Total de academias
        $total = (int) $db->table('academias')
            ->countAllResults();

        // Activas / inactivas
        $activas = (int) $db->table('academias')
            ->where('activa', 1)
            ->countAllResults();

        $inactivas = $total - $activas;

        // Academias activas con clase HOY
        // Solo contamos días de Lunes a Viernes (1–5)
        $activasHoy = 0;
        if ($diaHoy >= 1 && $diaHoy <= 5) {
            $activasHoy = (int) $db->table('academias a')
                ->join('academia_horarios ah', 'ah.academia_id = a.id')
                ->where('a.activa', 1)
                ->where('ah.dia_semana', $diaHoy)
                ->countAllResults();
        }

        // Total de alumnos inscritos en academias activas (sin duplicados)
        $totalAlumnos = (int) $db->table('academia_alumno aa')
            ->join('academias a', 'a.id = aa.academia_id')
            ->where('a.activa', 1)
            ->select('COUNT(DISTINCT aa.alumno_id) AS total')
            ->get()
            ->getRow()
            ->total;

        // Academias activas sin profesor asignado
        $sinProfesor = (int) $db->table('academias a')
            ->join('academia_profesor ap', 'ap.academia_id = a.id', 'left')
            ->where('a.activa', 1)
            ->where('ap.academia_id IS NULL', null, false) // LEFT JOIN sin match
            ->countAllResults();

        return [
            'total'         => $total,
            'activas'       => $activas,
            'inactivas'     => $inactivas,
            'activas_hoy'   => $activasHoy,
            'total_alumnos' => $totalAlumnos,
            'sin_profesor'  => $sinProfesor,
        ];
    }


    // ================================================================
    // MÉTODO 4 — Asignar profesor a una academia
    // ================================================================
    // Reemplaza el profesor actual (si existe) por el nuevo.
    // La tabla academia_profesor tiene PRIMARY KEY (academia_id, user_id),
    // así que primero elimina el registro anterior y luego inserta.
    // Si $userId es null, solo desasigna sin insertar nada.
    //
    // Uso:
    //   $this->academiaModel->asignarProfesor($academiaId, $userId);
    //   $this->academiaModel->asignarProfesor($academiaId, null); // desasignar
    // ================================================================
    public function asignarProfesor(int $academiaId, ?int $userId): bool
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // Eliminar asignación actual
        $db->table('academia_profesor')
            ->where('academia_id', $academiaId)
            ->delete();

        // Insertar nueva asignación solo si se proporcionó un usuario
        if ($userId !== null) {
            $db->table('academia_profesor')->insert([
                'academia_id' => $academiaId,
                'user_id'     => $userId,
            ]);
        }

        $db->transComplete();

        return $db->transStatus();
    }


    // ================================================================
    // MÉTODO 5 — Obtener el profesor asignado a una academia
    // ================================================================
    // Retorna array con los datos del usuario/profesor asignado,
    // o null si la academia no tiene profesor.
    //
    // Uso:
    //   $profesor = $this->academiaModel->getProfesor($academiaId);
    //   if ($profesor) { echo $profesor['nombre_completo']; }
    // ================================================================
    public function getProfesor(int $academiaId): ?array
    {
        $db = \Config\Database::connect();

        $row = $db->table('academia_profesor ap')
            ->select([
                'u.id',
                "CONCAT(u.first_name, ' ', u.last_name) AS nombre_completo",
                'u.email',
                'u.roles',
            ])
            ->join('users u', 'u.id = ap.user_id')
            ->where('ap.academia_id', $academiaId)
            ->get()
            ->getRowArray();

        return $row ?: null;
    }


    // ================================================================
    // MÉTODO 6 — Academias asignadas a un profesor (por user_id)
    // ================================================================
    // Útil para el dashboard del profesor y para la ficha de usuario.
    // Incluye los horarios de cada academia para no hacer N+1 después.
    //
    // Uso:
    //   $academias = $this->academiaModel->getDeProfesor($userId);
    //   $academias = $this->academiaModel->getDeProfesor($userId, true); // solo activas
    // ================================================================
    public function getDeProfesor(int $userId, bool $soloActivas = false): array
    {
        $db = \Config\Database::connect();

        $builder = $db->table('academias a')
            ->select([
                'a.id',
                'a.nombre',
                'a.sala',
                'a.cupos',
                'a.activa',
                'COUNT(DISTINCT aa.alumno_id) AS alumnos',
            ])
            ->join('academia_profesor ap', 'ap.academia_id = a.id')
            ->join('academia_alumno aa',  'aa.academia_id = a.id', 'left')
            ->where('ap.user_id', $userId)
            ->groupBy('a.id')
            ->orderBy('a.nombre', 'ASC');

        if ($soloActivas) {
            $builder->where('a.activa', 1);
        }

        $academias = $builder->get()->getResultArray();

        if (empty($academias)) {
            return [];
        }

        // Traer horarios en una sola query
        $ids      = array_column($academias, 'id');
        $horarios = $db->table('academia_horarios')
            ->whereIn('academia_id', $ids)
            ->orderBy('dia_semana', 'ASC')
            ->orderBy('hora_inicio', 'ASC')
            ->get()
            ->getResultArray();

        $horariosPorAcademia = [];
        foreach ($horarios as $h) {
            $horariosPorAcademia[$h['academia_id']][] = $h;
        }

        foreach ($academias as &$academia) {
            $academia['horarios'] = $horariosPorAcademia[$academia['id']] ?? [];
            $academia['alumnos']  = (int) $academia['alumnos'];
            $academia['cupos']    = (int) $academia['cupos'];
        }
        unset($academia);

        return $academias;
    }
}
