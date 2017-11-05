<?php

class Reporting extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports_m');
        $this->load->model('accounts_m');
        $this->load->model('expense_m');
    }

    public function index($id = null, $accID = null) {

        if (isset($_POST) && !empty($_POST)) {
            $accID = $_POST['to_bank'];
            $this->data['postData'] = $this->expense_m->get_current_month_data($id, $accID);
            $this->data['date_from'] = $_POST['date_from'];
            $this->data['date_to'] = $_POST['date_to'];
            $this->data['acc'] = $_POST['to_bank'];
//            echo json_encode($data);
        }

        $this->data['report'] = $this->reports_m->get_new();
        $this->data['userAccounts'] = $this->accounts_m->user_account();
        $this->data['dates'] = $this->reports_m->get_user_dates();
        $this->data['accounts'] = $this->accounts_m->get_user_account();
        $this->data['accout_types'] = array('Outgoing', 'Incoming');
        $this->data['subview'] = 'admin/reporting/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function displayReports($date_id = null, $AccountID = null) {

        $data = $this->expense_m->get_current_month_data($date_id, $AccountID);
        echo json_encode($data);
    }

    public function viewDetails($catID = null, $date_id = null, $date_from = null, $accID = null, $sub_cat_id = null) {
        $this->data['sub_expenses'] = $this->expense_m->subExpenseDetailView($catID, $date_id, $accID);
        if(strtotime($date_id) == TRUE)
        {
           $dates = array('date_from'=> $date_from, 'date_to'=>$date_to);
           $this->data['expenses'] = $this->expense_m->expenseDetailView($catID, $dates, $accID, $sub_cat_id);
        }
        else{
            echo "no";  
        }
        $this->data['expenses'] = $this->expense_m->expenseDetailView($catID, $date_id, $date_from, $sub_cat_id);
        $this->data['subview'] = 'admin/reporting/view';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function postRecordViewDetails() {
        if (isset($_POST) && !empty($_POST)) {
            $AccountID = $_POST['to_bank'];
//            echo json_encode($data);
        }
    }

}
