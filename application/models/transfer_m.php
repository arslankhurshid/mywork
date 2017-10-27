<?php

Class Transfer_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'user_transfer_amount';
    protected $_order_by = '';
    protected $_timestamps = TRUE;
    public $rules = array(
        'from_bank' => array(
            'field' => 'from_bank',
            'label' => 'From',
            'rules' => 'trim|required|max_length[100]|callback__id_not_null|xss_clean'
        ),
        'to_bank' => array(
            'field' => 'to_bank',
            'label' => 'To',
            'rules' => 'trim|required|max_length[100]|callback__id_no_null|xss_clean'
        ),
        'amount' => array(
            'field' => 'amount',
            'label' => 'Amount',
            'rules' => 'trim|max_length[100]|callback__avaliable_amount|xss_clean'
        ),
        'reference' => array(
            'field' => 'reference',
            'label' => 'Reference',
            'rules' => 'trim|max_length[100]|xss_clean'
        ),
    );

    public function get_new() {
        $transfer = new stdClass();
        $transfer->from_bank = '';
        $transfer->to_bank = '';
        $transfer->amount = '';
        $transfer->reference = '';
        
        return $transfer;
    }
    
//    public function getUserAccouts()
//    {
//        $this->db->select('id, title, description');
//        $this->db->where('user_id=', $this->session->id);
//
//        $accounts = parent::get();
//        $array = array(0=>'Select Account');
//        if (count($accounts)) {
//            foreach ($accounts as $account) {
//                $array[$account->id] = $account->title;
//            }
//        }
//        return $array;
//    }

}
