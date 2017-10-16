<?php

class Article extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('article_m');
    }

    public function index() {
        //Fetch all articles
        $this->data['articles'] = $this->article_m->get();

        $this->data['subview'] = 'admin/article/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {
        //Fetch the article or load the new one
        if ($id) {
            $this->data['article'] = $this->article_m->get($id);
            if (empty(count($this->data['article'])))
                $this->data['errors'][] = "Article could not be found";
        } else {
            $this->data['article'] = $this->article_m->get_new();
        }
        //Set up the form
        $rules = $this->article_m->rules;
        $this->form_validation->set_rules($rules);

        // process the form

        if ($this->form_validation->run() == TRUE) {
       
            $data = $this->article_m->array_from_post(array(
                'title',
                'slug',
                'body',
                'pub_date'
            ));
            
            $this->article_m->save($data, $id);
            redirect('admin/article');
        }
        $this->data['subview'] = 'admin/article/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function delete($id) {
        $this->article_m->delete($id);
        redirect('admin/article');
    }

}
