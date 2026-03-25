<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Academia extends BaseController
{
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
}
