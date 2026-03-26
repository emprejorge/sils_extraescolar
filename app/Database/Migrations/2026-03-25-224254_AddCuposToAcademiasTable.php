<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCuposToAcademiasTable extends Migration
{
    public function up()
    {
        $fields = [
            'cupos' => [
                'type'       => 'INT',
                'constraint' => 3,
                'null'       => true,
                'after'      => 'sala',
            ],
        ];

        $this->forge->addColumn('academias', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('academias', 'cupos');
    }
}
