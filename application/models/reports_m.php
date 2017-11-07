<?php

class reports_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'reports';
    protected $_order_by = '';
    protected $_timestamps = false;
    public $rules = array();

    public function get_new() {
        $report = new stdClass();
        $report->date_from = '';
        $report->date_to = '';

        return $report;
    }

    public function get_user_dates() {

//        $end_date = date('Y-m-d');
//        $dateArray = array(
//            'Current Month' => array('start_date' => date('Y-m-01'), 'end_date' => $end_date),
//            'Last Month' => array('start_date' => date('Y-m-d', strtotime('first day of previous month')), 'end_date' => date('Y-m-d', strtotime('last day of previous month'))),
//            'Last 6 Month' => array('start_date' => date("Y-m-01", strtotime("-6 month")), 'end_date' => $end_date),
//            'Last 12 Month' => array('start_date' => date("Y-m-01", strtotime("-12 month")), 'end_date' => $end_date),
//            'Current Year' => array('start_date' => date("Y-01-01"), 'end_date' => $end_date),
//            'Last Year' => array('start_date' => date("Y-01-01", strtotime("-1 year")), 'end_date' => date("Y-12-31", strtotime("-1 year"))),
//        );
        $dates = parent::get();

        $array = array();
        foreach ($dates as $date) {
            $array[$date->id] = $date->period;
        }
        return $array;
    }

}
