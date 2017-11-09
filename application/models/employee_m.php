<?php

class employee_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'employees';
    protected $_order_by = '';
    protected $_timestamps = TRUE;
    public $rules = array(
        'fname' => array(
            'field' => 'fname',
            'label' => 'First Name',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'lname' => array(
            'field' => 'lname',
            'label' => 'Last Name',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'dep' => array(
            'field' => 'lname',
            'label' => 'Department',
            'rules' => 'trim|max_length[100]|xss_clean'
        ),
    );

    public function get_all_employee() {
        // Fetch all pages w/out parents
        // Return key => value pair array
        $this->db->select('id, fname');
        $employees = parent::get();

        $array = array(0 => 'Select Employee');

        if (count($employees)) {
            foreach ($employees as $employee) {
                $array[$employee->id] = $employee->fname;
            }
        }
        return $array;
    }

    public function get_new() {
        $employee = new stdClass();
        $employee->fname = '';
        $employee->lname = '';
        $employee->dep = '';
        return $employee;
    }

}
