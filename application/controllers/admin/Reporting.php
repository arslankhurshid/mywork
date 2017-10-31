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
        $this->data['accounts'] = $this->accounts_m->get_user_account();
        $this->data['getDefaulValues'] = $this->reports_m->getDefaulValues();
        $this->data['defaultValues'] = $this->reports_m->get();
        $this->data['subview'] = 'admin/reporting/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function view($cat_id = null, $date_id = null, $accID = null) {

        if (isset($_REQUEST) && !empty($_REQUEST['cat_id']))
            $cat_id = $_REQUEST['cat_id'];
        if (isset($_REQUEST) && !empty($_REQUEST['date']))
            $date_id = $_REQUEST['date'];
        if (isset($_REQUEST) && !empty($_REQUEST['date']))
            $date_id = $_REQUEST['date'];

        $this->data['expenses'] = $this->expense_m->expenseDetailView($cat_id, $date_id, $accID);
        $this->data['subview'] = 'admin/reporting/view';
        $this->load->view('admin/_layout_main', $this->data);
    }

}
