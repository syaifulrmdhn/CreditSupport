<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class login extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Login_Model','',TRUE);
    }
    function proses_login(){      
      //get post data
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      
      //set peraturan untuk form validasi
      $this->form_validation->set_rules('username','Username','required|xss_clean');
      $this->form_validation->set_rules('password','Password','required|xss_clean');
     
      //run validation and check user database
      if($this->form_validation->run() == TRUE){
        if($this->Login_Model->cek_user('users',$username,$password) == TRUE){
            $akses = $this->Login_Model->get_hakakses('users',$username, $password);
            $this->session->set_userdata('isAdmin',TRUE);
            $this->session->set_userdata('adminname',$akses->username);
            redirect(base_url().'admin/index_admin'); //redirect ke halaman sesuai hakakses
        }
        else{
            $this->session->set_flashdata(array('message'=>'Anda belum terdaftar'));
            $this->session->set_flashdata(array('script'=>"<script>$('.dropdown-toggle').dropdown('toggle');</script>"));
            redirect(base_url().'admin/index_admin'); //redirect ke halaman sesuai hakakses
            
        }
      }
      else{
          $data['title'] = 'Admin Login Page';
          $data['script'] = "<script>$('.dropdown-toggle').dropdown('toggle');</script>";
          $this->load->view('admin/template_admin',$data);
      }
      
    }

    function logout(){
        $this->session->unset_userdata('isAdmin');
        $this->session->unset_userdata('adminname');
        redirect(base_url().'admin/index_admin');
    }
}
?>
