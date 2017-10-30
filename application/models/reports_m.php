<?php

class reports_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'expenses';
    protected $_order_by = '';
    protected $_timestamps = false;
    public $rules = array();

    public function getDefaulValues() {
        $data = array(
            'Incoming', 'Outgoing'
        );

        return $data;
    }

    public function get_new() {
        $report = new stdClass();
        $report->date_from = '';
        $report->date_to = '';

        return $report;
    }

    
    public function get_current_month_data($id = null, $single = null) {
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title, t4.title as sub_category, t4.id as sub_category_id,');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
        $this->db->where('expenses.date >=','2017-10-19');
        $this->db->where('expenses.date <=','2017-10-23');
        $catego = parent::get($id, $single);
        echo $this->db->last_query();
//        return parent::get($id, $single);
    }

}
