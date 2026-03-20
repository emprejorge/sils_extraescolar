<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserProvidersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            'provider' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],

            'provider_id' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],

            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['provider', 'provider_id']);
        $this->forge->addKey('user_id');

        $this->forge->addForeignKey(
            'user_id',
            'users',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->forge->createTable('user_providers');
    }

    public function down()
    {
        $this->forge->dropTable('user_providers');
    }
}
