<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Discount extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
			'id'=>[
				'type'=>'INT',
				'constraint'=>11,
				'unsigned'=>TRUE,
				'auto_increment'=>TRUE
			],
            'code_discount'=>[
                'type'=>'VARCHAR',
                'constraint'=>50,
            ],
            'discount'=>[
                'type'=>'INT',
                'constraint'=>11,
            ],
            'start_date'=>[
                'type'=>'DATE',
            ],
            'end_date'=>[
                'type'=>'DATE',
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('discount');
    }

    public function down()
    {
        //
        $this->forge->dropTable('discount');
    }
}
