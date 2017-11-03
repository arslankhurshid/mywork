<?php

class Reporting extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports_m');
        $this->load->model('accounts_m');
        $this->load->model('expense_m');
    }

    public function index($id = null, $accID = null) {

        $this->data['report'] = $this->reports_m->get_new();
        $this->data['userAccounts'] = $this->accounts_m->user_account();
        $this->data['dates'] = $this->reports_m->get_user_dates();
        $this->data['accounts'] = $this->accounts_m->get_user_account();
        $this->data['accout_types'] = array('Incoming', 'Outgoing');
        $this->data['subview'] = 'admin/reporting/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function displayReports($date_id = null, $AccountID = null) {
        $data = $this->expense_m->get_current_month_data($date_id, $AccountID);
        echo json_encode($data);
    }

    public function viewDetails($catID = null, $date_id = null, $accID = null, $sub_cat_id = null) {
        $this->data['sub_expenses'] = $this->expense_m->subExpenseDetailView($catID, $date_id, $accID);
        $this->data['expenses'] = $this->expense_m->expenseDetailView($catID, $date_id, $accID, $sub_cat_id);
        $this->data['subview'] = 'admin/reporting/view';
        $this->load->view('admin/_layout_main', $this->data);
    }

}
