<?php

class expense_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'expenses';
    protected $_order_by = 'date desc, id desc';
    protected $_timestamps = TRUE;
    public $rules = array(
        'date' => array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'trim|required|exact_length[10]|xss_clean'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'amount' => array(
            'field' => 'amount',
            'label' => 'Amount',
            'rules' => 'trim|required|max_length[100]|url_title|xss_clean'
        ),
        'new_cat' => array(
            'field' => 'new_cat',
            'label' => 'New Category',
            'rules' => 'trim|max_length[100]|callback__unique_cat|xss_clean'
        ),
    );

    public function get_with_categories($id = null, $single = null) {
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title, t4.title as sub_category, t4.id as sub_category_id,');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
//        $catego = parent::get($id, $single);
//        echo $this->db->last_query();
        return parent::get($id, $single);
    }

    public function delete($id) {
        //delete a expense
        parent::delete($id);
        //Reset expense_id for its category
        $this->db->where('expense_id', $id); //which row want to upgrade  
        $this->db->limit(1);
        $this->db->delete('expense_has_categories');
//        echo $this->db->last_query();
    }

    public function get_new() {
        $expense = new stdClass();
        $expense->date = date('Y-m-d');
        $expense->title = '';
        $expense->amount = '';
        $expense->category_id = 0;
        $expense->sub_category_id = 0;
        $expense->account_id = 0;

        return $expense;
    }

    // function to be used in reports
    public function get_current_month_data($id = null, $accountID = null) {
        if ($id == 3) {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
        } elseif ($id == 4) {
            $start_date = date('Y-m-d', strtotime('first day of previous month'));
            $end_date = date('Y-m-d', strtotime('last day of previous month'));
        } elseif ($id == 5) {
            $start_date = date("Y-m-01", strtotime("-6 month"));
            $end_date = date('Y-m-d');
        } elseif ($id == 6) {
            $start_date = date("Y-m-01");
            $end_date = date('Y-m-d');
        } elseif ($id == 7) {
            $start_date = date("Y-01-01");
            $end_date = date('Y-m-d');
        } elseif ($id == 8) {
            $start_date = date("Y-01-01", strtotime("-1 year"));
            echo $end_date = date("Y-12-31", strtotime("-1 year"));
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
        }

        if (isset($_POST) && !empty($_POST)) {
            $start_date = $_POST['date_from'];
            $end_date = $_POST['date_to'];
        }

        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title, t4.title as sub_category, t4.id as sub_category_id,');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
        $this->db->where('expenses.date >=', $start_date);
        $this->db->where('expenses.date <=', $end_date);
        if (!empty($accountID))
            $this->db->where('expenses.account_id=', $accountID);
        $result = parent::get();

        $array = array();
        $arr = array();
        foreach ($result as $key => $value) {
            $array[$value->category_id][$value->category_title][] = $value->amount;
        }
        foreach ($array as $k => $val) {
            if (is_array($val)) {
                foreach ($val as $index => $v) {
                    $arr[$k][$index] = array_sum($v);
                }
            }
        }

//        echo $this->db->last_query();
        return $arr;

//        return parent::get($id, $single);
    }

    public function expenseDetailView($cat_id = null, $id = null, $accountID = null) {
        if ($id == 3) {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
        } elseif ($id == 4) {
            $start_date = date('Y-m-d', strtotime('first day of previous month'));
            $end_date = date('Y-m-d', strtotime('last day of previous month'));
        } elseif ($id == 5) {
            $start_date = date("Y-m-01", strtotime("-6 month"));
            $end_date = date('Y-m-d');
        } elseif ($id == 6) {
            $start_date = date("Y-m-01");
            $end_date = date('Y-m-d');
        } elseif ($id == 7) {
            $start_date = date("Y-01-01");
            $end_date = date('Y-m-d');
        } elseif ($id == 8) {
            $start_date = date("Y-01-01", strtotime("-1 year"));
            echo $end_date = date("Y-12-31", strtotime("-1 year"));
        } else {
            $start_date = date('Y-m-01');
            $end_date = date('Y-m-d');
        }
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title, t4.title as sub_category, t4.id as sub_category_id,');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
        $this->db->where('expenses.date >=', $start_date);
        $this->db->where('expenses.date <=', $end_date);
        $this->db->where('t3.id=', $cat_id);
        if (!empty($accountID))
            $this->db->where('expenses.account_id=', $accountID);
        $result = parent::get();
//        echo $this->db->last_query();

        return $result;
    }

}
