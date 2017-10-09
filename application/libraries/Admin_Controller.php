<?php

class Admin_Controller extends My_Controller
{
    function __construct() {
        parent::__construct();
        $this->data['meta_title']= 'Tasker';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('user_m');
        $this->load->library('session');
        $this->load->helper('security');

    }
}