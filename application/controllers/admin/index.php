<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Index extends CI_Controller{

    function __construct() {
        parent::__construct();
        
    }
    function index(){
        $data['title'] = 'Admin Page';
        $this->load->model('login_model','',TRUE);
        $this->login_model->test();
        $this->load->view('admin/form',$data);
       
    } 
    function proses_login(){
        //set rules untuk validasi
        $this->form_validation->rules('username','Username','required|xss_clean');
        $this->form_validation->rules('password','Password','required|xss_clean');
        //cek validasi
        if($this->form_validation->run() == TRUE){
            //data valid
            //cek ke database username dan password nya ada atau ga
            $this->load->model('login_model','',TRUE);
            $username = $this->input->post('username');
            if($this->login_model->cek_user($username,$password)){
                //login
            }
            else{
                //tampilkan error
            }
        }else{
            //data tidak valid
            
        }
    }
}
?>
