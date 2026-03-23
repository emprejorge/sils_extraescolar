<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\RoleModel;
use CodeIgniter\I18n\Time;
use App\Controllers\BaseController;

class Admin extends BaseController
{

    public function index()
    {
        $usuarioModel = new UserModel();
        $roleModel = new RoleModel();

        $data = [
            'totalUsuarios' => $usuarioModel->countAll(),
            'usuarios' => $usuarioModel->getUserList(),
            'roles' => $roleModel->getRoles(),
            'title' => 'Escritorio'
        ];

        return $this->render('admin/dashboard', $data);
    }
}
