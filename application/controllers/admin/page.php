<?php

Class page extends Frontend_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('page_m');
    }
    
    public function index(){
        
        $pages = $this->page_m->get();
        echo "<pre>";
        print_r($pages);
        echo "</pre>";
    }
    
//    public function save()
//    {
//        $data = array(
//            'order' => '3',
//        );
//        
//        $id = $this->page_m->save($data, 3);
//        
//        echo "<pre>";
//        print_r($id);
//        echo "</pre>";
//    }
//    
//    public function delete()
//    {
//        $id = 3;
//        $this->page_m->delete($id);
//    }
}
