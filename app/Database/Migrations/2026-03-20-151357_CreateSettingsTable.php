<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'key' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
            'value' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'autoload' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 1
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('key');
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
