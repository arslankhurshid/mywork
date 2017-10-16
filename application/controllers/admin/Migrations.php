<?php

Class Migrations extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->library('migration');
    }

    function index() 
    {
        
//        $migration = $this->migration->version(5);
//        print_r($migration);
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
