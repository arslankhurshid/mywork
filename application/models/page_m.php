<?php

Class page_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'pages';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'order';
    protected $_rules = array();
    protected $_timestamps = FALSE;

}
