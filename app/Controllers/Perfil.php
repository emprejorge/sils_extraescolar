<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\RoleModel;

class Perfil extends BaseController
{
    public function index()
    {
        $usuarioModel = new UserModel();
        $roleModel = new RoleModel();

        $academias = [
            [
                'id' => 1,
                'nombre'  => 'Academia de Robótica',
                'activa'  => '1',
                'horario' => 'Lunes 15:30 - 17:00'
            ],
            [
                'id' => 2,
                'nombre'  => 'Academia de Arte',
                'activa'  => '1',
                'horario' => 'Martes 16:00 - 17:30'
            ],
            [
                'id' => 3,
                'nombre'  => 'Academia de Fútbol',
                'activa'  => '0',
                'horario' => 'Miércoles 15:00 - 16:30'
            ],
            [
                'id' => 4,
                'nombre'  => 'Academia de Programación',
                'activa'  => '1',
                'horario' => 'Jueves 16:00 - 18:00'
            ]
        ];
        $data = [
            'usuario' => $usuarioModel->getUserFullData(user()->id),
            'roles' => $roleModel->getRoles(),
            'academias' => $academias
        ];
        return $this->render('common/profile', $data);
    }
}
