<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAsistenciaDetalle extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'sesion_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'alumno_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'presente' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('sesion_id');
        $this->forge->addKey('alumno_id');
        $this->forge->addUniqueKey(['sesion_id', 'alumno_id'], 'uq_detalle');

        $this->forge->addForeignKey('sesion_id', 'asistencia_sesiones', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('alumno_id', 'alumnos', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('asistencia_detalle', true);
    }

    public function down()
    {
        $this->forge->dropTable('asistencia_detalle', true);
    }
}
