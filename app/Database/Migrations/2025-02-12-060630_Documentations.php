<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Documentations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'    => 10,
                'unsigned'      => true,
                'auto_increment'=> true
            ],
            'guestbook_id' => [
                'type'      => 'INT',
                'constraint'=> 10,
                'unsigned'  => true
            ],
            'image_name'   => [
                'type'      => 'VARCHAR',
                'constraint'=> '255'
            ],
            'created_at' => [
                'type'          => 'DATETIME',
                'null'          => true
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('documentations');
    }

    public function down()
    {
        $this->forge->dropTable('documentations');
    }
}
