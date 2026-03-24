<?php

namespace App\Controllers\Profesor;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\RoleModel;

class Profesor extends BaseController
{
    public function index()
    {
        $usuarioModel = new UserModel();
        $roleModel = new RoleModel();

        $data = [
            'totalUsuarios' => $usuarioModel->countAll(),
            'usuarios' => $usuarioModel->getUserList(),
            'roles' => $roleModel->getRoles(),
            'title' => 'Escritorio',
            'profesor' => $usuarioModel->getUserFullData(user()->id),
            'academias_hoy' => 0,             // int — cantidad total programadas hoy
            'academias_pendientes'      => array(['nombre' => 'Futbol Damas', 'horario' => 'Lunes de 15:30 a 17:00', 'sala' => '', 'id' => 1, 'total_alumnos' => 25]),
            'academias_completadas_hoy' => array([
                'nombre' => 'Futbol Varones',
                'horario' => 'Lunes de 17:00 a 18:30',
                'sala' => '',
                'id' => 2,
                'total_alumnos' => 25,
                'presentes' => 20,
                'ausentes' => 5,
            ]), // academias de hoy ya registradas
            'todas_academias' => array(
                ['nombre' => 'Futbol Damas', 'horario' => 'Lunes de 15:30 a 17:00', 'sala' => '', 'id' => 1, 'total_alumnos' => 25, 'asistencia_promedio' => 83],
                ['nombre' => 'Futbol Varones', 'horario' => 'Lunes de 17:00 a 18:30', 'sala' => '', 'id' => 2, 'total_alumnos' => 25, 'asistencia_promedio' => 79],
            ), // todas sus academias con 'asistencia_promedio'
            'ultimos_registros' => array(
                [
                    'total_alumnos' => 25,
                    'presentes' => 20,
                    'academia_nombre' => 'Futbol Damas',
                    'fecha' => '24-03-2026'
                ],
                [
                    'total_alumnos' => 25,
                    'presentes' => 18,
                    'academia_nombre' => 'Futbol Damas',
                    'fecha' => '17-03-2026'
                ],
                [
                    'total_alumnos' => 25,
                    'presentes' => 23,
                    'academia_nombre' => 'Futbol Varones',
                    'fecha' => '17-03-2026'
                ]

            ),
        ];


        return $this->render('profesor/dashboard', $data);
    }
}
