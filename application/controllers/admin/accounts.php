<?php

Class accounts extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('accounts_m');
        $this->load->model('transfer_m');
    }

    public function index() {
        $this->data['accounts'] = $this->accounts_m->get_user_account();
        $this->data['subview'] = 'admin/accounts/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = null) {

        $accounts = $this->accounts_m->get_user_account();
        if ($this->session->role_id == 1) {
            // only one account is allowed
            if (count($accounts) >= 1 || count($accounts) >= 6) {
                $this->data['count_here'] = count($accounts);
                $this->data['user_account_limit'] = "This account has a limit to " . count($accounts) . " Account";
            }
        } elseif ($this->session->role_id == 2) {
            // maximum 5 accounts are allowed
            if (count($accounts) >= 6) {
                $this->data['count_here'] = count($accounts);
                $this->data['user_account_limit'] = "This account has a limit to " . count($accounts) . " Accounts";
            }
        }
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
            //save user transfer amount 
            $this->transfer_m->save($data, $id);
            //update user account balance
            $accounts = $this->accounts_m->get_user_account();
            $sum = array();
            foreach ($accounts as $account) {
                if ($data['to_bank'] == $account->id) {
                    $sum['balance'] = $data['amount'] + $account->balance;
                    $this->accounts_m->save($sum, $account->id);
                } elseif ($data['from_bank'] == $account->id) {
                    $sum['balance'] = $account->balance - $data['amount'];
                    $this->accounts_m->save($sum, $account->id);
                }
            }
            redirect('admin/accounts');
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

    public function _avaliable_amount() {
        if (isset($_POST) && $_POST['amount'] !== '') {
            $accounts = $this->accounts_m->get();
            foreach ($accounts as $account) {
                if ($_POST['from_bank'] == $account->id) {
                    if ($_POST['amount'] > $account->balance) {
                        $this->form_validation->set_message('_avaliable_amount', 'The Transfer amount is greater than avaliable balance. Avaliable amount =' . $account->balance);
                        return FALSE;
                    } else {
                        return TRUE;
                    }
                }
            }
        }
    }

    public function updateDropDownField($fromID) {
        $accountArray = $this->accounts_m->getUserAccouts($fromID);
        echo json_encode($accountArray);
    }

}
