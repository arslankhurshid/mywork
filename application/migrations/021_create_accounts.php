<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_accounts extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'desc' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'amount' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'balance' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
            'created' => array(
                'type' => 'DATETIME',
            ),
            'modified' => array(
                'type' => 'DATETIME',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('accounts');
    }

    public function down() {
        $this->dbforge->drop_table('accounts');
    }

}
