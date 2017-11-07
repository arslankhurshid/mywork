<?php

class expense extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('expense_m');
        $this->load->model('categories_m');
        $this->load->model('expense_has_cat_m');
        $this->load->model('accounts_m');
    }

    public function index() {
        //Fetch all expenses
        $this->data['expenses'] = $this->expense_m->get_with_categories();
        //Load view
        $this->data['subview'] = 'admin/expense/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = null) {
        $array = array();
        $this->data['categories'] = $this->categories_m->get_no_parents();
        $this->data['accounts'] = $this->accounts_m->getUserAccouts();
        if ($id) {
            $this->data['expense'] = $this->expense_m->get_with_categories($id);
            if ($this->data['expense']->sub_category_id !== '') {
                $this->data['sub_categories'] = $this->categories_m->getSubCatArray($this->data['expense']->category_id);
            }

            if (empty(count($this->data['expense'])))
                $this->data['errors'][] = "expense could not be found";
        }
        else {

            $this->data['expense'] = $this->expense_m->get_new();
            $this->data['sub_categories'] = $this->categories_m->get_sub_categories();
        }

        $rules = $this->expense_m->rules;
        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            // GET post data 
            // save new cat if posted
            if (isset($_POST) && $_POST['new_cat']) {
                $array['cat_id'] = $this->categories_m->save_cat_return_id(array(
                    'title' => $this->input->post('new_cat'),
                        )
                );
            } else {
                $array['cat_id'] = $_POST['cat_id'];
            }
            // save expense here
            $expense = $this->expense_m->array_from_post(array(
                'date',
                'title',
                'amount',
                'account_id',
                'user_id'
            ));
            $userID['user_id'] = $this->session->id;
            $data = array_merge($expense, $userID);
            $array['expense_id'] = $this->expense_m->save($expense, $id);
            if ($array['expense_id'] == '') {
                $array['expense_id'] = $id;
            }
            $array['sub_cat_id'] = $this->input->post('sub_cat_id');
            // save cat to relational table
            $this->expense_has_cat_m->save($array, $id);
            // update selected account 
            $sum = array();
            $accounts = $this->accounts_m->get_user_account();
            foreach ($accounts as $account) {
                if ($expense['account_id'] == $account->id) {
                    $sum['balance'] = $account->balance - $expense['amount'];
                    $this->accounts_m->save($sum, $account->id);
                }
            }
            redirect('admin/expense');
        }
        $this->data['subview'] = 'admin/expense/edit';
        $this->data['subview_cat'] = 'admin/categories/cat';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function _unique_cat($str) {
        $tes = $this->db->where('title', $this->input->post('new_cat'));
        $cat = $this->categories_m->get();
        if (count($cat)) {
            $this->form_validation->set_message('_unique_cat', 'Category already exists');
            return FALSE;
        }
        return TRUE;
    }

    public function delete($id) {
        $this->expense_m->delete($id);
        redirect('admin/expense');
    }

    public function updateDropDownField($value) {
        if ($value == 0) {
            $this->data['sub_categories'] = array(0 => 'No Category');
        } else {
            $this->data['sub_categories'] = $this->categories_m->getSubCatArray($value);
        }
        echo json_encode($this->data['sub_categories']);
    }

}
