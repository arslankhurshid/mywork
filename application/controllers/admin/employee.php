<?php

Class employee extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('employee_m');
    }

    public function index() {
        $this->data['employees'] = $this->employee_m->get();
        $this->data['subview'] = 'admin/employee/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = Null) {
        if ($id) {
            $this->data['employee'] = $this->employee_m->get($id);
            if (empty(count($this->data['employee'])))
                $this->data['errors'][] = "Page could not be found";
        }
        else {
            $this->data['employee'] = $this->employee_m->get_new();
        }
        // employees for drop down menu
//        $this->data['employees'] = $this->employee_m->get_all_employee($id);
        $rules = $this->employee_m->rules;
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->employee_m->array_from_post(array('fname', 'lname', 'dep',));
            $this->employee_m->save($data, $id);
            redirect('admin/employee');
        }
        $this->data['subview'] = 'admin/employee/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {
        $this->employee_m->delete($id);
        redirect('admin/employee');
    }

}
