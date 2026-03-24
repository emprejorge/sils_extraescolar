<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAcademiaHorarios extends Migration
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
            'academia_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'dia_semana' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
            ],
            'hora_inicio' => [
                'type' => 'TIME',
            ],
            'hora_fin' => [
                'type' => 'TIME',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('academia_id');

        $this->forge->addForeignKey('academia_id', 'academias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('academia_horarios', true);
    }

    public function down()
    {
        $this->forge->dropTable('academia_horarios', true);
    }
}
