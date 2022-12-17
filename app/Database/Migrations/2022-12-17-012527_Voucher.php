<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Voucher extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'=>[
				'type'=>'INT',
				'constraint'=>11,
				'unsigned'=>TRUE,
				'auto_increment'=>TRUE
			],
			'kode_voucher'=>[
                'type'=>'TEXT',
				'constraint'=>11,
            ],
            'besar_diskon'=>[
                'type'=>'INT',
				'constraint'=>2,
			],
			'aktif'=>[
				'type'=>'INT',
				'constraint'=>2,
			],
			'created_by'=>[
				'type' => 'INT',
				'constraint' => 11,
			],
			'created_date'=>[
				'type' => 'DATETIME',
			],
		]);

		$this->forge->addKey('id', TRUE); 
		$this->forge->createTable('voucher');


    }

    public function down()
    {
        //
		$this->forge->dropTable('voucher');
    }
}
