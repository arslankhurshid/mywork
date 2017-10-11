<?php

Class page extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('page_m');
    }

    public function index() {
        $this->data['pages'] = $this->page_m->get();

        $this->data['subview'] = 'admin/pages/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = Null) {
        if ($id) {
            $this->data['page'] = $this->page_m->get($id);
            if (empty(count($this->data['page'])))
                $this->data['errors'][] = "Page could not be found";
        }
        else {
            $this->data['page'] = $this->page_m->get_new();
        }

        $rules = $this->page_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->page_m->array_from_post(array('title', 'slug', 'body'));
            $this->page_m->save($data, $id);
            redirect('admin/page');
        }
        $this->data['subview'] = 'admin/pages/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function delete($id)
    {
        $this->page_m->delete($id);
        redirect('admin/page');
    }
    
    public function _unique_slug()
    {
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        
        !$id || $this->db->where('id !=', $id);
        $page = $this->page_m->get();
        if(count($page))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
                    
        }
        return TRUE;
    }

}
