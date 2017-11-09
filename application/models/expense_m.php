<?php

class expense_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'expenses';
    protected $_order_by = 'date desc';
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

    public function joinQuery() {
        // Join with Categories and expenses
        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title,t5.employee_id,t6.fname as employee_fname,,t6.lname as employee_lname,t6.dep, t4.title as sub_category, t4.id as sub_category_id');
        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
        $this->db->join('expense_has_employees as t5', 'expenses.id=t5.expense_id', 'left');
        $this->db->join('employees as t6', 't5.employee_id=t6.id', 'left');
        $this->db->where('expenses.user_id=', $this->session->id);
    }

    public function dateQuery($id = null) {
//        echo $id;
        if (is_array($id)) {
            $start_date = date('Y-m-d', $id['date_from']);
            $end_date = date('Y-m-d', $id['date_to']);
        }
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
            $start_date = date("Y-m-01", strtotime("-12 month"));
            $end_date = date('Y-m-d');
        } elseif ($id == 7) {
            $start_date = date("Y-01-01");
            $end_date = date('Y-m-d');
        } elseif ($id == 8) {
            $start_date = date("Y-01-01", strtotime("-1 year"));
            $end_date = date("Y-12-31", strtotime("-1 year"));
        }
//        else {
//            $start_date = date('Y-m-01');
//            $end_date = date('Y-m-d');
//        }
//        if (isset($_POST) && !empty($_POST)) {
//            $start_date = $_POST['date_from'];
//            $end_date = $_POST['date_to'];
//        }
        $array = array('start_date' => $start_date, 'end_date' => $end_date);
//        print_r($array);
        return $array;
    }

    public function get_with_categories($id = null, $single = null) {
//        echo $id;
//        $this->db->select('expenses.*, expenses.id as expense_id, expenses.title as expense_title, t3.id as category_id, t3.title as category_title, t4.title as sub_category, t4.id as sub_category_id,');
//        $this->db->join('expense_has_categories as t2', 'expenses.id = t2.expense_id', 'left');
//        $this->db->join('categories as t3', 't2.cat_id = t3.id', 'left');
//        $this->db->join('categories as t4', 't2.sub_cat_id = t4.id', 'left');
//        $catego = parent::get($id, $single);
        $this->joinQuery();

        return parent::get($id, $single);
//        echo $this->db->last_query();
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
        $expense->employee_id = 0;

        return $expense;
    }

    // function to be used in reports
    public function get_current_month_data($id = null, $accountID = null) {
        $get_dates = $this->dateQuery($id);
        $this->joinQuery();
        $this->db->where('expenses.date >=', $get_dates['start_date']);
        $this->db->where('expenses.date <=', $get_dates['end_date']);
        if (!empty($accountID))
            $this->db->where('expenses.account_id=', $accountID);
        $this->db->order_by($this->_order_by);
//        $result = parent::get();
        $array = array();
        $arr = array();
        $results = $this->db->get('expenses')->result_array();
//        echo $this->db->last_query();
        $array = array();
        foreach ($results as $result) {
            $array[$result['category_id']][$result['category_title']][] = $result['amount'];
        }
        foreach ($array as $k => $val) {
            if (is_array($val)) {
                foreach ($val as $index => $v) {
                    $sum = array_sum($v);
                    $arr[] = array(
                        'total' => $sum,
                        'cat_id' => $k,
                        'account_id' => $result['account_id'],
                        'category_title' => $index,
                        'date_from' => $get_dates['start_date'],
                        'date_to' => $get_dates['end_date'],
                    );
                }
            }
        }
        return $arr;
    }

    public function expenseDetailView($cat_id = null, $date_from = null, $date_to = null, $accountID = null, $sub_cat_id = null) {
//        $get_dates = $this->dateQuery($id);
        $this->joinQuery();

        $this->db->where('expenses.date >=', date('Y-m-d', $date_from));
        $this->db->where('expenses.date <=', date('Y-m-d', $date_to));
        $this->db->where('t3.id=', $cat_id);
        if (!empty($sub_cat_id))
            $this->db->where('t4.id=', $sub_cat_id);
        if (!empty($accountID))
            $this->db->where('expenses.account_id=', $accountID);
        $result = parent::get();
//        echo $this->db->last_query();

        return $result;
    }

    public function subExpenseDetailView($cat_id = null, $date_from = null, $date_to = null, $accountID = null) {

        $this->joinQuery();
        $this->db->where('expenses.date >=', date('Y-m-d', $date_from));
        $this->db->where('expenses.date <=', date('Y-m-d', $date_to));
        $this->db->where('t3.id=', $cat_id);
        if (!empty($accountID))
            $this->db->where('expenses.account_id=', $accountID);
//        $results = parent::get();
        $this->db->order_by($this->_order_by);
        $results = $this->db->get('expenses')->result_array();
//        echo $this->db->last_query();

        $array = array();
        foreach ($results as $result) {
            $array[$result['sub_category_id']][$result['sub_category']][] = $result['amount'];
        }
        foreach ($array as $k => $val) {
            if (is_array($val)) {
                foreach ($val as $index => $v) {
                    $sum = array_sum($v);
                    $arr[] = array(
                        'total' => $sum,
                        'cat_id' => $result['category_id'],
                        'sub_category_id' => $k,
                        'account_id' => $result['account_id'],
                        'sub_category_title' => $index,
                        'date_from' => $date_from,
                        'date_to' => $date_to,
                    );
                }
            }
        }

        return $arr;
    }

    public function employeeExpenseDetailView($cat_id = null, $date_from = null, $date_to = null, $accountID = null, $sub_cat_id = null) {
        $this->joinQuery();

        $this->db->where('expenses.date >=', date('Y-m-d', $date_from));
        $this->db->where('expenses.date <=', date('Y-m-d', $date_to));
        $this->db->where('t3.id=', $cat_id);
        if (!empty($sub_cat_id))
            $this->db->where('t4.id=', $sub_cat_id);
        if (!empty($accountID))
            $this->db->where('expenses.account_id=', $accountID);
        $this->db->order_by($this->_order_by);
        $results = $this->db->get('expenses')->result_array();
        $array = array();
        $anotherArray = array();
        $finalArray = array();

        foreach ($results as $result) {

            $array[$result['employee_id']][$result['sub_category']][] = $result['amount'];
        }
        foreach ($array as $index => $val) {
            foreach ($val as $key => $v) {
                $sum = array_sum($v);
                $arr[$index][$key] = $sum;
            }
        }

        foreach ($results as $result) {

            $anotherArray[$result['employee_id']] = array(
                'cat_id' => $result['category_id'],
                'cat_name' => $result['category_title'],
                'account_id' => $result['account_id'],
                'employee_fname' => $result['employee_fname'],
                'employee_lname' => $result['employee_lname'],
                'date_from' => $date_from,
                'date_to' => $date_to,
            );
        }

        foreach ($arr as $key => $val) {
            $val2 = $anotherArray[$key];
            $finalArray[$key] = $val + $val2;
        }
        
        return $finalArray;
    }

}
