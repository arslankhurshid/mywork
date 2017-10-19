<?php

class expense extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('expense_m');
        $this->load->model('categories_m');
        $this->load->model('expense_has_cat_m');
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
        if ($id) {
            $this->data['expense'] = $this->expense_m->get_with_categories($id);
            if (empty(count($this->data['expense'])))
                $this->data['errors'][] = "expense could not be found";
        }
        else {
            $this->data['expense'] = $this->expense_m->get_new();
        }
        $this->data['categories'] = $this->categories_m->get_all_categories();
        $rules = $this->expense_m->rules;
        $rules = array_merge($this->categories_m->rules, $rules);

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            // GET post data 
            // save new cat if posted
            echo "all is well";
            exit();
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
            ));
            $array['expense_id'] = $this->expense_m->save($expense, $id);
            if ($array['expense_id'] == '') {
                $array['expense_id'] = $id;
            }
            // save cat to relational table
            $this->expense_has_cat_m->save($array, $id);

            redirect('admin/expense');
        }
        $this->data['subview'] = 'admin/expense/edit';
        $this->data['subview_cat'] = 'admin/categories/index';
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

}
