<?php

class Reporting extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports_m');
        $this->load->model('accounts_m');
        $this->load->model('expense_m');
    }

    public function index() {
        //load the current month data
        $this->data['expense_month'] = $this->expense_m->get_current_month_data();

//        exit();
        $this->data['report'] = $this->reports_m->get_new();
        $this->data['accounts'] = $this->accounts_m->get_user_account();
        $this->data['getDefaulValues'] = $this->reports_m->getDefaulValues();
        $this->data['defaultValues'] = $this->reports_m->get();
        $this->data['subview'] = 'admin/reporting/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function selected_date($id) {
        $dateVal = array(
            '3' => 'Current Month',
            '4' => 'Last Month',
            '5' => 'Last 6 Month',
            '6' => 'Last 12 Month',
            '7' => 'Current Year',
            '8' => 'Last Year',
        );
        $dateVal = array_flip($dateVal);
//        echo "<pre>";
////        print_r(array_flip($dateVal);
//        echo "</pre>";
        if (in_array($id, $dateVal)) {
            echo "all is well";
            $this->data['expense_month']= $this->expense_m->get_current_month_data($id);
            $this->data['report'] = $this->reports_m->get_new();
            $this->data['accounts'] = $this->accounts_m->get_user_account();
            $this->data['getDefaulValues'] = $this->reports_m->getDefaulValues();
            $this->data['defaultValues'] = $this->reports_m->get();
            $this->data['subview'] = 'admin/reporting/index';
            $this->load->view('admin/_layout_main', $this->data);
        }
    }

    public function search() {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        exit();

        $this->data['subview'] = 'admin/reporting/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

}
