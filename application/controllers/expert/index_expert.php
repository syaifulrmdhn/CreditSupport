<?php
/*-- file : back-end Expert controller --*/
if(!defined('BASEPATH')) exit('No direct script allowed');

class Index_Expert extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $data['title'] = 'Home Page';
        $this->load->view('expert/template_expert',$data);
    }
    function index_2(){
        echo 'index2';
    }
}
?>
