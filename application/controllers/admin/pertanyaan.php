<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Pertanyaan extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('pertanyaan_model','',TRUE);
    }
    public function index(){
        $data['pertanyaan'] = $this->pertanyaan_model->ambil_pertanyaan();
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/pertanyaan';
        $this->load->view('admin/template_admin',$data);
    }
    public function tambah_pertanyaan(){
        if($this->input->post()){
            $pertanyaan = $this->input->post('pertanyaan');
            $store2db = array();
            foreach($pertanyaan as $p){
                $store2db[]['pertanyaan'] = $p;
            }
            if($this->pertanyaan_model->tambah_pertanyaan($store2db)){
                $this->session->set_flashdata('message','<p class="alert alert-success">Berhasil tambah pertanyaan</p>');
                redirect(base_url().'admin/pertanyaan/tambah_pertanyaan');
            }else{
                $this->session->set_flashdata('message','<p class="alert alert-error">Gagal tambah pertanyaan</p>');
                redirect(base_url().'admin/pertanyaan/tambah_pertanyaan');                
            }
        }
        $data['pertanyaan'] = $this->pertanyaan_model->ambil_pertanyaan();
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_pertanyaan';
        $this->load->view('admin/template_admin',$data);
    }
    public function ubah_pertanyaan($id_pertanyaan){
          if($this->input->post()){
            $pertanyaan = $this->input->post('pertanyaan');
            $store2db = array('pertanyaan'=>$pertanyaan);
            
            if($this->pertanyaan_model->ubah_pertanyaan($id_pertanyaan,$store2db)){
                $this->session->set_flashdata('message','<p class="alert alert-success">Berhasil tambah pertanyaan</p>');
                redirect(base_url().'admin/pertanyaan/');
            }else{
                $this->session->set_flashdata('message','<p class="alert alert-error">Gagal tambah pertanyaan</p>');
                redirect(base_url().'admin/pertanyaan/');                
            }
        }
        $data['id_pertanyaan'] = $id_pertanyaan;
        $data['pertanyaan'] = $this->pertanyaan_model->ambil_pertanyaan_byid($id_pertanyaan);
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_pertanyaan';
        $this->load->view('admin/template_admin',$data);
    }
    public function hapus_pertanyaan($id_pertanyaan){
        if($this->pertanyaan_model->hapus_pertanyaan($id_pertanyaan) == TRUE){
             $this->session->set_flashdata('message','<p class="alert alert-success">Berhasil hapus pertanyaan</p>');
             redirect(base_url().'admin/pertanyaan');  
        }else{
             $this->session->set_flashdata('message','<p class="alert alert-error">Gagal hapus pertanyaan</p>');
             redirect(base_url().'admin/pertanyaan');  
        }
    }
}
?>
