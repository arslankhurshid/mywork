<?php

class dashboard extends Admin_Controller
{
    function __construct() 
    {
        parent::__construct();
        $this->load->helper('url');

    }
    function index()
    {
        $this->load->view('admin/_layout_main.php', $this->data);
    }
    function modal()
    {
        $this->load->view('admin/_layout_model.php', $this->data['subview']);
    }
}