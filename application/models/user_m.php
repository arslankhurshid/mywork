<?php

Class user_m extends My_Model {

    protected $_table_name = 'users';
    protected $_order_by = 'name';
    public $rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|xss_clean'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'),
    );

    public function __construct() {
        parent::__construct();
    }

    public function login() {

        $user = $this->get_by(array(
            'email' => $this->input->post('email'),
            'password' => $this->hash($this->input->post('password'))
                ), TRUE);
        
        echo "<pre>" . print_r($user). "</pre>";

        if (!empty($user)) {
            $data = array(
                'name' => $user->name,
                'email' => $user->email,
                'id' => $user->id,
                'loggedin' => TRUE,
            );
            $this->session->set_userdata($data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
    }

    public function loggedin() {

        return (bool) $this->session->set_userdata('loggedin');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

}
