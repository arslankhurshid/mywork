<?php

Class expense_has_employee_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'expense_has_employees';
    protected $_primary_key = 'id';
    protected $_order_by = '';
    protected $_timestamps = FALSE;
    public $rules = array();

}
