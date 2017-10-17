<?php

Class Categories extends Admin_Controller{
    public function __construct() {
        parent::__construct();
    }
    
    function index()
    {
        $this->data['subview'] = 'admin/categories/index';
        $this->load->view('admin/_layout_main.php', $this->data);
    }
    function modal()
    {
        $this->load->view('admin/_layout_model.php', $this->data['subview']);
    }
    function edit($id = null)
    {
        echo "all is well";
        
    }
    
}