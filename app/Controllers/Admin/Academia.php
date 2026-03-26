<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Academia extends BaseController
{
    protected $academiaModel;
    protected $horarioModel;

    public function __construct()
    {
        $this->academiaModel = new \App\Models\AcademiaModel();
        $this->horarioModel  = new \App\Models\HorarioModel();
    }

    public function index()
    {
        $usuarioModel = new UserModel();


        $stats = [
            'total'          => 8,   // COUNT(*) FROM academias
            'activas_hoy'    => 3,   // academias con horario en dia_semana = hoy
            'total_alumnos'  => 94,  // COUNT DISTINCT alumnos inscritos en alguna academia activa
            'sin_profesor'   => 1,   // academias sin profesor asignado
        ];

        $data = [

            'profesores' => $usuarioModel->getTeacherList(),
            'stats' => $stats,
            'title' => 'Usuarios'
        ];
        return $this->render('admin/academias/index', $data);
    }


    /**
     * GUARDAR
     */
    public function guardar()
    {

        // 1. Insertar academia
        $academiaId = $this->academiaModel->insert([
            'nombre'      => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
            'sala'        => $this->request->getPost('sala'),
            'cupos'       => $this->request->getPost('cupos'),
            'activa'      => $this->request->getPost('activa') ? 1 : 0,
        ]);

        // 2. Insertar horarios (siempre borra y recrea en edición)
        foreach ($this->request->getPost('horarios') as $h) {
            $this->horarioModel->insert([
                'academia_id' => $academiaId,
                'dia_semana'  => $h['dia_semana'],
                'hora_inicio' => $h['hora_inicio'],
                'hora_fin'    => $h['hora_fin'],
            ]);
        }

        // 3. Asigna profesor
        $profesor = $this->request->getPost('profesor');
        if (!empty($profesor)) {
            $this->academiaModel->asignarProfesor($academiaId, $profesor);
        }


        return redirect()->to('/admin/academias')
            ->with('success', 'Academia creada exitosamente');
    }

    public function asignar()
    {
        return $this->render('admin/academias/asignar');
    }
}
