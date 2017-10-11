<?php

class user extends Admin_Controller {

    public function __construct() {
        parent::__construct();
    }

    // curd method
    public function index() {
        //Fetch all users
        $this->data['users'] = $this->user_m->get();
        //Load view
        $this->data['subview'] = 'admin/user/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    // edit and add user function
    public function edit($id = NULL) {
        if ($id) {
            $this->data['user'] = $this->user_m->get($id);
            if (empty(count($this->data['user'])))
                $this->data['errors'][] = "User could not be found";
        }
        else {
            $this->data['user'] = $this->user_m->get_newUser();
        }

        $rules = $this->user_m->rules_admin;
        if ($id != NULL) {
            $rules['password']['rules'] .= '|required';
        }
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->user_m->array_from_post(array('name', 'email', 'password'));
            $data['password'] = $this->user_m->hash($data['password']);
            $this->user_m->save($data, $id);
            redirect('admin/user');
        }
        $this->data['subview'] = 'admin/user/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {

        $this->user_m->delete($id);
        redirect('admin/user');
    }

    public function login() {
        // Redirect the user if already login 
        $dashboard = 'admin/user/login';
        $this->user_m->loggedin() == FALSE || redirect($dashboard);
        //set form
        $rules = $this->user_m->rules;
        $this->form_validation->set_rules($rules);
        // process form
        if ($this->form_validation->run() == TRUE) {
//            $this->user_m->login();
            if ($this->user_m->login() == TRUE) {
                $this->session->set_flashdata('success', "login successfully");
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('errors', "Wrong Email or Password");
                redirect('admin/user/login');
            }
        }
        //load view
        $this->data['subview'] = 'admin/user/login';
        $this->load->view('admin/_layout_model', $this->data);
    }

    public function _unique_email($str) {
        //Do not validate if email already exists 
        // unless its the email for the current user
        $id = $this->uri->segment(4);
        $this->db->where('email', $this->input->post('email'));
        !$id || $this->db->where('id !=', $id);
        $user = $this->user_m->get();
        if (count($user)) {
            $this->form_validation->set_message('_unique_email', 'Email already exists');
            return FALSE;
        }
        return TRUE;
    }

    public function logout() {
        $this->user_m->logout();
        redirect('admin/user/login');
    }

}
