<?php

class expense_m extends My_Model {

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

    public function get_with_categories($id = null, $single = null) {
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        return parent::get($id, $single);
    }

    public function delete($id) {
        //delete a expense
        parent::delete($id);
        //Reset expense_id for its category
        $this->db->where('expense_id', $id); //which row want to upgrade  
        $this->db->limit(1);
        $this->db->delete('expense_has_categories');
//        echo $this->db->last_query();
    }

    public function get_new() {
        $expense = new stdClass();
        $expense->date = date('Y-m-d');
        $expense->title = '';
        $expense->amount = '';
        $expense->category_id = 0;

        return $expense;
    }

}
