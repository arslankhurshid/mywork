<?php

Class accounts extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('accounts_m');
        $this->load->model('transfer_m');
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
                'user_id'
            ));

            $userID['user_id'] = $this->session->id;
            $data = array_merge($data, $userID);
            $this->accounts_m->save($data, $id);
            redirect('admin/accounts');
        }


        $this->data['subview'] = 'admin/accounts/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {
        $this->accounts_m->delete($id);
        redirect('admin/accounts');
    }

    public function transfer($id = null) {

        if ($id) {
            $this->data['user_accounts'] = $this->accounts_m->getUserAccouts();
            
        } else {
            $this->data['user_accounts'] = $this->accounts_m->getUserAccouts();
            $this->data['account'] = $this->transfer_m->get_new();
        }

        $rules = $this->transfer_m->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            //insert
            $data = $this->transfer_m->array_from_post(array(
                'from_bank',
                'to_bank',
                'amount',
                'reference'
            ));
            $this->transfer_m->save($data, $id);
        }

        $this->data['subview'] = 'admin/accounts/transfer';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function _id_not_null() {
        if (isset($_POST) && $_POST['from_bank'] == 0) {
            $this->form_validation->set_message('_id_not_null', 'From Account Field can not be empty');
            return FALSE;
        }
        return TRUE;
    }

    public function _id_no_null() {
        if (isset($_POST) && $_POST['to_bank'] == 0) {
            $this->form_validation->set_message('_id_no_null', 'To Account Field can not be empty');
            return FALSE;
        }
        return TRUE;
    }

}
