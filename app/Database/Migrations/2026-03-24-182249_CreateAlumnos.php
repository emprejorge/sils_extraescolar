<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlumnos extends Migration
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
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
            ],
            'apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => 80,
            ],
            'curso_id' => [
                'type'       => 'INT',
                'constraint' => 10,
                'unsigned'   => true,
                'null'       => true,
            ],
            'activo' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('curso_id');

        $this->forge->addForeignKey('curso_id', 'cursos', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('alumnos', true);
    }

    public function down()
    {
        $this->forge->dropTable('alumnos', true);
    }
}
