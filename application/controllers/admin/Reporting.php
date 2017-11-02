<?php

class Reporting extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports_m');
        $this->load->model('accounts_m');
        $this->load->model('expense_m');
    }

    public function index($id = null, $accID = null) {
//        print_r($_REQUEST);
        if (isset($_REQUEST) && !empty($_REQUEST['account']))
            $accID = $_REQUEST['account'];
        if (isset($_REQUEST) && !empty($_REQUEST['date']))
            $id = $_REQUEST['date'];
        //load the current month data
        $this->data['expense_month'] = $this->expense_m->get_current_month_data($id, $accID);

        $this->data['report'] = $this->reports_m->get_new();
        $this->data['userAccounts'] = $this->accounts_m->user_account();
        $this->data['dates'] = $this->reports_m->get_user_dates();
        $this->data['accounts'] = $this->accounts_m->get_user_account();
        $this->data['getDefaulValues'] = $this->reports_m->getDefaulValues();
        $this->data['defaultValues'] = $this->reports_m->get();
        $this->data['accout_types'] = array('Incoming', 'Outgoing');
        $this->data['subview'] = 'admin/reporting/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function view($id = null, $cat_id = null, $date_id = null, $accID = null, $sub_cat_id = null) {
        $sub_cat_id = $this->uri->segment(5);
        if (isset($_REQUEST) && !empty($_REQUEST['cat_id']))
            $cat_id = $_REQUEST['cat_id'];
        if (isset($_REQUEST) && !empty($_REQUEST['date']))
            $date_id = $_REQUEST['date'];
        if (isset($_REQUEST) && !empty($_REQUEST['date']))
            $date_id = $_REQUEST['date'];

        $this->data['expenses'] = $this->expense_m->expenseDetailView($cat_id, $date_id, $accID, $sub_cat_id);
        $this->data['sub_expenses'] = $this->expense_m->subExpenseDetailView($cat_id, $date_id, $accID);
        $this->data['subview'] = 'admin/reporting/view';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function displayReports($date_id = null, $AccountID=null ) {

//        echo $date_id. '/' . $AccountID;
        $data = $this->expense_m->get_current_month_data($date_id, $AccountID);
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
        echo json_encode($data);
//        $newData=    explode(" ", $data);

//        print_r($_REQUEST);
//        print_r($newData);
    }

}
