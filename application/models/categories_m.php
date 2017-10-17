<?php

class categories_m extends My_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    protected $_table_name = 'categories';
    protected $_order_by = 'id desc';
    protected $_timestamps = TRUE;
    public $rules = array(
        'new_cat' => array(
            'field' => 'new_cat',
            'label' => 'Category',
            'rules' => 'trim|max_length[100]|xss_clean'
        ),
    );
    
    public function get_all_categories() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $this->db->select('id, title');
        $categories = parent::get();

        $array = array(0 => 'Select');

        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->id] = $category->title;
            }
        }
        return $array;
    }
    
    public function save_cat_return_id($data)
    {
//        echo $query = "INSERT INTO categories (title) VALUES ('John')";
//        $res = $this->db->query($query);
//        echo "<pre>";
//        print_r($res);
//        echo "</pre>";
//        $lastID = $this->db->insert_id();
        
//        exit();
        $this->db->set($data);
        $this->db->insert('categories', $data);
//        echo $this->db->last_query();
        echo $lastID = $this->db->insert_id();
        echo $this->db->last_query();
        return $lastID;
    }
    /*public function get_with_categories($id = null, $single = null)
    {
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t2.id as category_id, t3.title as category_title');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.id', 'left');
        $this->db->join('categories as t3', 't2.id = t3.id', 'left');
        return parent::get($id, $single);
        
    }
    public function get_new() {
        $expense = new stdClass();
        $expense->date = date('Y-m-d');
        $expense->title = '';
        $expense->amount = '';
        
        return $expense;
    }*/
    
    
}