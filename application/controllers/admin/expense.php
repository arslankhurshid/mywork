<?php

class expense extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('expense_m');
    }

    public function index() {
        //Fetch all expenses
        $this->data['expenses'] = $this->expense_m->get_with_categories();
        //Load view
        $this->data['subview'] = 'admin/expense/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id= null) {
        if ($id) {
            $this->data['expense'] = $this->expense_m->get($id);
            if (empty(count($this->data['expense'])))
                $this->data['errors'][] = "expense could not be found";
        }
        else {
            $this->data['expense'] = $this->expense_m->get_new();
        }
        
        $this->data['categories'] = $this->page_m->get();
        
        $rules = $this->expense_m->rules;

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            // GET post data 
            $data = $this->expense_m->array_from_post(array(
                'date',
                'title',
                'amount',
            ));

            $this->expense_m->save($data, $id);
            redirect('admin/expense');
        }
        $this->data['subview'] = 'admin/expense/edit';
        $this->load->view('admin/_layout_main', $this->data);
                
                
    }
    
    public function delete($id)
    {
        $this->expense_m->delete();
        redirect('admin/expense');
    }

}
