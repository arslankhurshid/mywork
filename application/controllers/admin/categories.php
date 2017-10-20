<?php

Class Categories extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('categories_m');
        $this->load->model('expense_m');
    }

    function index() {
        $this->data['categories'] = $this->categories_m->get_with_parent();
        $this->data['subview'] = 'admin/categories/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function modal() {
//        $this->load->view('admin/_layout_model.php', $this->data['subview']);
    }

    public function edit($id = null) {
        if ($id) {
            $this->data['category'] = $this->categories_m->get($id);
            if (empty(count($this->data['category'])))
                $this->data['errors'][] = "Category could not be found";
        }
        else {
            $this->data['category'] = $this->categories_m->get_new();
        }

        // pages for drop down menu
        $this->data['categories_without_parents'] = $this->categories_m->get_no_parents();

        $rules = $this->categories_m->rules;
        echo "<pre>";
        print_r($rules);
        echo "</pre>";
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            // INSERT THE CATEGORY
            $data = $this->categories_m->array_from_post(array(
                'title',
                'parent_id',
            ));
            $this->categories_m->save($data, $id);
            redirect('admin/categories');
        }

        $this->data['subview'] = 'admin/categories/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function _unique_cat($str) {
        $id = $this->uri->segment(4);
        $this->db->where('title', $this->input->post('title'));
        !$id || $this->db->where('id !=', $id);

        $cat = $this->categories_m->get();
        if (count($cat)) {
            $this->form_validation->set_message('_unique_cat', 'Category already exists');
            return FALSE;
        }
        return TRUE;
    }

}
