<?php

class user extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    // curd method
    public function index()
    {
        $this->data['users'] = $this->user_m->get();
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main' , $this->data);
    }
    
    public function edit($id = NULL)
    {
        $this->data['user'] = $this->user_m->get($id);
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function delete($id)
    {
        
    }

        public function login() {
      
        $dashboard = 'admin/user/login';
        $this->user_m->loggedin() == FALSE || redirect($dashboard);
        $rules = $this->user_m->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
//            $this->user_m->login();
            if ($this->user_m->login() == TRUE) {
                $this->session->set_flashdata('success', "login successfully");
                redirect('admin/user');
            } else {
                $this->session->set_flashdata('errors', "Wrong Email or Password");
                redirect('admin/user/login');
            }
        }

        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_model', $this->data);
    }

    public function logout() {
        $this->user_m->logout();
        redirect('admin/user/login');
    }

}
