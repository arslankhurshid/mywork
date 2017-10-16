<?php

class expense_m extends My_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    protected $_table_name = 'expenses';
    protected $_order_by = 'date desc, id desc';
    protected $_timestamps = TRUE;
    public $rules = array(
        'date' => array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'trim|required|exact_length[10]|xss_clean'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'amount' => array(
            'field' => 'amount',
            'label' => 'Amount',
            'rules' => 'trim|required|max_length[100]|url_title|xss_clean'
        ),
    );
    
    public function get_with_categories($id = null, $single = null)
    {
        echo "all is well";

        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title');
        $this->db->join('expense_has_categories as c', 'expenses.id = c.id', 'left');
        parent::get($id, $single);
        
    }
    public function get_new() {
        $expense = new stdClass();
        $expense->date = date('Y-m-d');
        $expense->title = '';
        $expense->amount = '';
        
        return $expense;
    }
    
    
}