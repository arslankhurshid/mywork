<?php

Class page_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'pages';
    protected $_order_by = 'order';
    public $rules = array(
        'parent_id' => array(
            'field' => 'parent_id',
            'label' => 'Parent',
            'rules' => 'trim|intval'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'slug' => array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|max_length[100]|url_title|callback__unique_slug|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required'
        ),
    );

    public function get_new() {
        $page = new stdClass();
        $page->title = '';
        $page->slug = '';
        $page->body = '';
        $page->parent_id = 0;
        return $page;
    }

    public function delete($id) {
        //delete a page
        parent::delete($id);
        //Reset parent id for its children
        $this->db->set('parent_id', 0); //value that used to update column  
        $this->db->where('parent_id', $id); //which row want to upgrade  
        $this->db->update($this->_table_name);  //table name
    }

    public function get_nested() {
        $this->db->order_by("order", "asc");
        $pages = $this->db->get('pages')->result_array();
        $array = array();
        foreach ($pages as $page) {
            if (!$page['parent_id']) {
                $array[$page['id']] = $page;
            } else {
                $array[$page['parent_id']]['children'][] = $page;
            }
        }
        return $array;
    }

    public function save_order($pages) {
        if (count($pages)) {
            foreach ($pages as $order => $page) {
                if ($page['item_id'] !== '') {
                    $data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
                    $this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
                }
            }
        }
    }

    public function get_with_parent($id = NULL, $single = Null) {
        $this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
        $this->db->join('pages as p', 'pages.parent_id = p.id', 'left');
//        echo $this->db->last_query();

        return parent::get($id, $single);
    }

    public function get_no_parents($id = null) {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $this->db->select('id, title');
        $this->db->where('parent_id', 0);
        $this->db->where('id!=', $id);

        $pages = parent::get();
//        echo $this->db->last_query();

        $array = array(0 => 'No parent');

        if (count($pages)) {
            foreach ($pages as $page) {
                $array[$page->id] = $page->title;
                if ($id != null) {
                    $parents = $this->get_with_parent();
                    $parentID = array();
                    foreach ($parents as $parent) {
                        $parentID[$parent->parent_id] = $parent->parent_title;
                        if ($parent->parent_id == $id) {
                            unset($array[$page->id]);
                        }
                    }
                }
            }
        }


        return $array;
    }

    function updateArray($array, $findKey, $findValue) {

        foreach ($array as $key => $value) {

            if ($key == $findKey AND $value == $findValue) {
                unset($array[$key]);
                return $array;
            }
        }

        $array[$findKey] = $findValue;
        return $array;
    }

}
