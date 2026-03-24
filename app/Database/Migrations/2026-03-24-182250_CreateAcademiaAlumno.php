<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAcademiaAlumno extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'academia_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'alumno_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'fecha_inscripcion' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);

        $this->forge->addKey(['academia_id', 'alumno_id'], true);
        $this->forge->addKey('alumno_id');

        $this->forge->addForeignKey('academia_id', 'academias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('alumno_id', 'alumnos', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('academia_alumno', true);
    }

    public function down()
    {
        $this->forge->dropTable('academia_alumno', true);
    }
}
