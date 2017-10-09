<?php

Class My_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function get($id = Null, $single = FALSE) {
        if ($id != Null) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_filter, $id);
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if (!count($this->db->order_by($this->_order_by))) {
            $this->db->order_by($this->_order_by);
        }
        return $this->db->get($this->_table_name)->$method();
    }

    public function get_by($where, $single = FALSE) {
        $this->db->where($where);
        return $this->get(NULL, $single);
    }

    public function save($data, $id = Null) {

        //set timestamps
        if ($this->_timestamps === TRUE) {
            $now = date('D-m-y H:i:s');
            $id || $date['created'] = $now;
            $data['modified'] = $now;
        }

        // insert
        if ($id === Null) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = Null;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $lastinserted_id = $this->db->insert_id();
        }
        //update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }
    }

    public function delete($id) {
        echo $id;
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

}
