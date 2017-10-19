<?php

Class accounts extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('accounts_m');
    }

    public function index() {
        $this->data['accounts'] = $this->accounts_m->get();
        $this->data['subview'] = 'admin/accounts/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = null) {

        if ($id) {
            $this->data['account'] = $this->accounts_m->get($id);
            if (empty(count($this->data['account'])))
                $this->data['errors'][] = "account could not be found";
        }
        else {
            $this->data['account'] = $this->accounts_m->get_new();
        }

        $rules = $this->accounts_m->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            // INSERT NEW ACCOUNT
            $data = $this->accounts_m->array_from_post(array(
                'title',
                'description',
                'amount',
                'balance',
            ));

            $this->accounts_m->save($data, $id);
            redirect('admin/accounts');
        }


        $this->data['subview'] = 'admin/accounts/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {
        $this->accounts_m->delete($id);
        redirect('admin/article');
    }

}
