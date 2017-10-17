<?php

Class Migrations extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
//        $this->load->library('migration');
    }

    function index() 
    {
        error_reporting(E_ALL);
        $this->load->library('migration');
//        $this->load->library('migration');
        $migration = $this->migration->version();
        print_r($migration);
         echo "all is wel";
        exit();
        if ($this->migration->current() === FALSE) 
        {
            show_error($this->migration->error_string());
        }
        else
        {
            echo "Migration worked";
        }
    }

}
