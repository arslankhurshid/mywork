<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_expense_has_categories extends CI_Migration {

    public function up() {
        $fields = (array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'expense_id' => array(
                'type' => 'INT',
//                'default' => 0,
            ),
            'cat_id' => array(
                'type' => 'INT',
//                'default' => 0,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_column('expense_has_categories', $fields);
    }

    public function down() {
        $this->dbforge->drop_column('expense_has_categories');
    }

}
