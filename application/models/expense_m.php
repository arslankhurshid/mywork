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
        'new_cat' => array(
            'field' => 'new_cat',
            'label' => 'New Category',
            'rules' => 'trim|max_length[100]|callback__unique_cat|xss_clean'
        ),
    );

    public function get_with_categories($id = null, $single = null) {
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title, t4.title as sub_category, t4.id as sub_category_id,');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
        $this->db->where('expenses.date >=', '2017-10-19');
        $this->db->where('expenses.date <=', '2017-10-23');
        $catego = parent::get($id, $single);
        echo $this->db->last_query();
//        return parent::get($id, $single);
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
        $expense->sub_category_id = 0;
        $expense->account_id = 0;

        return $expense;
    }

    // function to be used in reports
    public function get_current_month_data($id = null, $single = null) {
        $now = date('Y-m-d');
        $startOfMonth = date('Y-m-01');
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title, t4.title as sub_category, t4.id as sub_category_id,');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
        $this->db->where('expenses.date >=', $startOfMonth);
        $this->db->where('expenses.date <=', $now);
        $result = parent::get($id, $single);

        $array = array();
        foreach ($result as $res) {
            echo "<pre>";
            print_r($res);
            echo "</pre>";
            
            
        }
        echo "<pre>";
        print_r($array);
        echo "</pre>";

        echo $this->db->last_query();
//        return parent::get($id, $single);
    }

}
