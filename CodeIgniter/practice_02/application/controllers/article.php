<?php

if (!defined('BASEPATH')) exit('No directscript access allow');

class Article extends CI_Controller{

    public function author()
    {
        $this->load->view('article_author');
    }

    public function post()
    {
        $this->load->view('article_post');
    }

    public function edit()
    {
        $this->load->view('article_edit');
    }
}

?>