<?php

class article_m extends My_Model
{
    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'articles';
    protected $_order_by = 'pub_date desc, id desc';
    protected $_timestamps = TRUE;
    public $rules = array(
        'pub_date' => array(
            'field' => 'pub_date',
            'label' => 'Publication Date',
            'rules' => 'trim|required|exact_length[10]|xss_clean'
        ),
        'title' => array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'slug' => array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|max_length[100]|url_title|xss_clean'
        ),
        'body' => array(
            'field' => 'body',
            'label' => 'Body',
            'rules' => 'trim|required'
        ),
    );
    
    public function get_new() {
        $article = new stdClass();
        $article->title = '';
        $article->slug = '';
        $article->body = '';
        $article->pub_date = date('Y-m-d');
        return $article;
    }
}