<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_expenses extends CI_Migration {

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
            'date' => array(
                'type' => 'DATE',
            ),
            'amount' => array(
                'type' => 'TEXT',
            ),
            'created' => array(
                'type' => 'DATETIME',
            ),
            'modified' => array(
                'type' => 'DATETIME',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('expenses');
    }

    public function down() {
        $this->dbforge->drop_table('expenses');
    }

}
