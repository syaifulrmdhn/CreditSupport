<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Artikel_Controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('artikel_model','',TRUE);
    }
    function index(){
        $data['title'] = 'Home Page';
        $data['artikel'] = $this->artikel_model->ambil_artikel();
        $data['content'] = 'artikel';
        $this->load->view('template',$data);
    }
    function view($id_artikel){
        $data['title'] = 'Home Page';
        $data['artikel'] = $this->artikel_model->ambil_artikel(array('id_artikel'=>$id_artikel));
        $data['komentar'] = $this->artikel_model->ambil_komentar(array('id_artikel'=>$id_artikel));
        $data['content'] = 'view_artikel';
        $this->load->view('template',$data);
    }
    function post_comment($id_artikel){
        $this->form_validation->set_rules('email','Email','required');
        $this->form_validation->set_rules('nama','Nama','required');
        if($this->form_validation->run() == TRUE){
            $comment = $this->input->post('komentar');
            $email = $this->input->post('email');
            $name = $this->input->post('nama');
            $store2db = array('id_artikel'=>$id_artikel,'komentar'=>$comment,
                              'date_added'=>date('Y-m-d H:i:s'),'author'=>$name,'email'=>$email);
            if($this->artikel_model->tambah_komentar($store2db)==TRUE){
                $this->session->set_flashdata('message','<p class="alert alert-success">Komentar berhasil di posting</p>');
                redirect(base_url().'artikel_controller/view/'.$id_artikel.'/comment');
            }else{
                $this->session->set_flashdata('message','<p class="alert alert-error">Ada Kesalahan</p>');
                redirect(base_url().'artikel_controller/view/'.$id_artikel.'/comment');
            }
        }else{
                $this->session->set_flashdata('email_form_error',form_error('email','<p class="text-error">','</p>'));
                $this->session->set_flashdata('name_form_error',form_error('nama','<p class="text-error">','</p>'));
                redirect(base_url().'artikel_controller/view/'.$id_artikel.'/comment');
        }
    }
}
?>