<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAsistenciaSesiones extends Migration
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
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
            ],
            'fecha' => [
                'type' => 'DATE',
            ],
            'observacion' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('academia_id');
        $this->forge->addKey('user_id');
        $this->forge->addUniqueKey(['academia_id', 'fecha'], 'uq_sesion');

        $this->forge->addForeignKey('academia_id', 'academias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('asistencia_sesiones', true);
    }

    public function down()
    {
        $this->forge->dropTable('asistencia_sesiones', true);
    }
}
