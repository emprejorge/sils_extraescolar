<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'code'        => 'admin',
                'name'        => 'Administrador',
                'description' => 'Administrador del sistema: Acceso total al sistema',
                'created_at'  => date('Y-m-d H:i:s')
            ],

            [
                'code'        => 'profesor',
                'name'        => 'Profesor',
                'description' => 'Docente del establecimiento',
                'created_at'  => date('Y-m-d H:i:s')
            ],

            [
                'code'        => 'secretaria',
                'name'        => 'Secretaría',
                'description' => 'Personal administrativo',
                'created_at'  => date('Y-m-d H:i:s')
            ],

        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
