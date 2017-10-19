<?php

Class expense_has_cat_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'expense_has_categories';
    protected $_primary_key = 'expense_id';
    protected $_order_by = '';
    protected $_timestamps = FALSE;
    public $rules = array();

}
