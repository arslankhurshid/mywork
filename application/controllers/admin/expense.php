<?php

class expense extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('expense_m');
        $this->load->model('categories_m');
    }

    public function index() {
        //Fetch all expenses
        $this->data['expenses'] = $this->expense_m->get_with_categories();
        //Load view
        $this->data['subview'] = 'admin/expense/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = null) {
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

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() == TRUE) {
            // GET post data 
            // save to expenses

           
            if (isset($_POST) && $_POST['new_cat']) {
                $this->save_the_cat();
                
            }
           
//             $data = $this->expense_m->array_from_post(array(
//                'date',
//                'title',
//                'amount',
//            ));
//            $cat['expense_id'] = $this->expense_m->save($data, $id);
//             echo "<pre>";
//            print_r($cat);
//            echo "</pre>";
            exit();
            // save a new category
//            if ($this->input->post('new_cat')) {
//                $save_cat = $this->categories_m->array_from_post(array(
//                    'id',
//                    'title'
//                ));
//                $this->categories_m->save($save_cat, $id);
//            }
            // save into relational table
//            $cat['cat_id'] = $this->expense_m->array_from_post(array(
//                'cat_id'
//            ));
//            $this->expense_m->save_expense_to_cat($cat, $id);

//            redirect('admin/expense');
        }
        $this->data['subview'] = 'admin/expense/edit';
        $this->data['subview_cat'] = 'admin/categories/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function save_the_cat($data=null, $id = null) {

//        echo "all is well";
//        exit();
        $data = array(
        'title'=>$this->input->post('new_cat'),
        
          );
        
        print_r($data);
        $this->categories_m->save_cat_return_id($data);
//        echo $cat_id;
//        exit();
        return TRUE;

//        print_r($data);
//         exit();
//        $this->categories_m->save($data, $id);


//        if ($this->categories_m->save($data, $id) == TRUE) {
//            $lastID[] = $this->expense_m->save_expense_to_cat($data, $id);
//
//            echo "<pre>";
//            print_r($lastID);
//            echo "</pre>";
//        }
    }

    public function delete($id) {
        $this->expense_m->delete($id);
        redirect('admin/expense');
    }

}
