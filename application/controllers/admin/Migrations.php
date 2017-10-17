<?php

Class Migrations extends Admin_Controller {

    function __construct() 
    {
        parent::__construct();
        $this->load->library('migration');
    }

    function index() 
    {
//        echo "all is wel";
//        exit();
        
//        $migration = $this->migration->version();
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
