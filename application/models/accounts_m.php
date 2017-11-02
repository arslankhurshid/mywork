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
        $accounts->account_id = '';
        return $accounts;
    }

    public function user_account() {
        $this->db->where('user_id=', $this->session->id);
        $result = parent::get();
        $array = array();
        foreach ($result as $res) {

            $array[$res->id] = $res->title;
        }
        return $array;
    }

    public function get_user_account($id = null, $sigle = FALSE) {
        $this->db->where('user_id=', $this->session->id);
        return parent::get();
    }

    public function getUserAccouts($id = null) {
        $this->db->select('id, title, description');
        if ($id) {
            $this->db->where('id!=', $id);
        } else {
//              $this->db->select('id, title, description');
            $this->db->where('user_id=', $this->session->id);
        }
//         $this->db->select('id, title, description');
//            $this->db->where('user_id=', $this->session->id);
        $accounts = parent::get();
        $array = array(0 => 'Select Account');
        if (count($accounts)) {
            foreach ($accounts as $account) {
                $array[$account->id] = $account->title;
            }
        }
        return $array;
    }

}
