<?php

namespace App\Controllers\Profesor;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Asistencia extends BaseController
{
    public function pasar()
    {


        return $this->render('profesor/asistencia/pasar');
    }
}
