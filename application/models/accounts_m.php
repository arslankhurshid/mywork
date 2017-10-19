<?php

Class Accounts_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'accounts';
    protected $_order_by = '';
    protected $_timestamps = TRUE;
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'description' => array(
            'field' => 'description',
            'label' => 'Description',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'amount' => array(
            'field' => 'amount',
            'label' => 'Amount',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'balance' => array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|max_length[100]|xss_clean'
        ),
    );

    public function get_new() {
        $accounts = new stdClass();
        $accounts->title = '';
        $accounts->description = '';
        $accounts->amount = '';
        $accounts->balance = '';
        return $accounts;
    }

}
