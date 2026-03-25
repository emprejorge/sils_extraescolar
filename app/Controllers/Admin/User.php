<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\RoleModel;

class User extends BaseController
{
    public function index()
    {
        $usuarioModel = new UserModel();
        $roleModel = new RoleModel();

        $data = [
            'totalUsuarios' => $usuarioModel->countAll(),
            'usuarios' => $usuarioModel->getSimpleUserList(),
            'roles' => $roleModel->getRoles(),
            'totalActivos' => 1,
            'totalPendientes' => 0,
            'totalInactivos' => 1,
            'pager' => null,
            'title' => 'Usuarios'
        ];

        return $this->render('admin/usuarios/index', $data);
    }

    public function show($id)
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
            'usuario' => $usuarioModel->getUserFullData($id),
            'roles' => $roleModel->getRoles(),
            'academias' => $academias,
            'title' => 'Usuario'
        ];
        return $this->render('admin/usuarios/show', $data);
    }

    public function new()
    {
        $roleModel = new RoleModel();

        $areas = array(
            'Lenguaje',
            'Matemática',
            'Artes',
            'Deporte',
            'Ciencias',
            'Tecnología'
        );

        $data = [
            'roles' => $roleModel->getRoles(),
            'areas' => $areas,
            'title' => 'Usuario nuevo'
        ];
        return $this->render('admin/usuarios/new', $data);
    }
}
