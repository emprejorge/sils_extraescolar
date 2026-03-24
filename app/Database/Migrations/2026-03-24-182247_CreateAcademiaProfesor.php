<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAcademiaProfesor extends Migration
{
    public function up()
    {
        $this->forge->addField([
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
        ]);

        $this->forge->addKey(['academia_id', 'user_id'], true);
        $this->forge->addKey('user_id');

        $this->forge->addForeignKey('academia_id', 'academias', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('academia_profesor', true);
    }

    public function down()
    {
        $this->forge->dropTable('academia_profesor', true);
    }
}
