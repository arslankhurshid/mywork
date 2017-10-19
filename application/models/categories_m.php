<?php

class categories_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'categories';
    protected $_order_by = '';
    protected $_timestamps = TRUE;
    public $rules = array(
        'new_cat' => array(
            'field' => 'new_cat',
            'label' => 'Category',
            'rules' => 'trim|max_length[100]|callback__unique_cat|xss_clean'
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

    public function save_cat_return_id($data) {
        parent::save($data);
        $this->db->set($data);
        $this->db->insert('categories', $data);
//        echo $this->db->last_query();
        $lastID = $this->db->insert_id();
        return $lastID;
    }

}
