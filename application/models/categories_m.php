<?php

class categories_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'categories';
    protected $_order_by = '';
    protected $_timestamps = TRUE;
    public $rules = array(
        'title' => array(
            'field' => 'title',
            'label' => 'Category',
            'rules' => 'trim|required|max_length[100]|callback__unique_cat|xss_clean'
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

    public function get_new() {
        $category = new stdClass();
        $category->title = '';
        $category->parent_id = 0;
        return $category;
    }

    public function get_with_parent($id = null, $single = null) {
        $this->db->select('categories.*, c.title as parent_title');
        $this->db->join('categories as c', 'categories.parent_id = c.id', 'left');
//        echo $this->db->last_query();

        return parent::get($id, $single);
    }

    public function get_no_parents() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $this->db->select('id, title');
        $this->db->where('parent_id', 0);
        $categories = parent::get();



        $array = array(0 => 'No parent');

        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->id] = $category->title;
            }
        }
        return $array;
    }

}
