<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Academia extends BaseController
{
    public function index()
    {
        return $this->render('admin/academias/index', array('title' => 'Academias'));
    }
}
