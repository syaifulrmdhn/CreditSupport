<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Jawaban extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('jawaban_model','',TRUE);
        $this->load->model('pertanyaan_model','',TRUE);
    }
    public function index(){
        $data['pertanyaan'] = $this->jawaban_model->ambil_jawaban();
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/jawaban';
        $this->load->view('admin/template_admin',$data);
    }
    public function tambah_jawaban($id_pertanyaan){
        if($this->input->post()){
            $pil_jawaban = $this->input->post('pil_jawaban');
            $id = $this->input->post('id_pertanyaan');
            $jawaban = $this->input->post('jawaban');
            $store2db = array();
            $i = 0;
            foreach($pil_jawaban as $pj){
                $store2db[$i]['pilihan_jawaban'] = $pj;
                $store2db[$i]['id_pertanyaan'] = $id;
                $i++;
            }
            if($this->jawaban_model->tambah_jawaban($store2db)){
                $this->pertanyaan_model->set_jawaban($id,$jawaban);
                $this->session->set_flashdata('message','<p class="alert alert-success">Berhasil tambah pertanyaan</p>');
                redirect(base_url().'admin/pertanyaan');
            }else{
                $this->session->set_flashdata('message','<p class="alert alert-error">Gagal tambah pertanyaan</p>');
                redirect(base_url().'admin/pertanyaan/');                
            }
        }
        $data['pertanyaan'] = $this->pertanyaan_model->ambil_pertanyaan_byid($id_pertanyaan);
        $data['jawaban'] = $this->jawaban_model->ambil_jawaban_byid($id_pertanyaan);
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_jawaban';
        $this->load->view('admin/template_admin',$data);
    }
    public function ubah_jawaban($id_pertanyaan=null){
             if($this->input->post()){
            $jawaban = $this->input->post('jawaban');
            $pil_jawaban = $this->input->post('pil_jawaban');
            $id_pertanyaan = $this->input->post('id_pertanyaan');
            $id_jawaban = $this->input->post('id_jawaban');
            $store2dbpertanyaan = array('jawaban'=>$jawaban);
            $store2db = array();
            $i=0;
            foreach($pil_jawaban as $pj){
                $store2db[$i]['pilihan_jawaban'] = $pj;
                $store2db[$i]['id_jawaban'] = $id_jawaban[$i];
                $i++;
            }
            //print_r($store2db);
            $this->jawaban_model->ubah_jawaban($store2db);
            if($this->pertanyaan_model->ubah_pertanyaan($id_pertanyaan,$store2dbpertanyaan)){
                $this->session->set_flashdata('message','<p class="alert alert-success">Berhasil ubah jawaban</p>');
                redirect(base_url().'admin/pertanyaan');
            }else{
                $this->session->set_flashdata('message','<p class="alert alert-error">Gagal ubah jawaban</p>');
                redirect(base_url().'admin/pertanyaan');                
            }
        }
        $data['pertanyaan'] = $this->pertanyaan_model->ambil_pertanyaan_byid($id_pertanyaan);
        $data['jawaban'] = $this->jawaban_model->ambil_jawaban_byid($id_pertanyaan);
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_jawaban';
        $this->load->view('admin/template_admin',$data);
    }
    public function hapus_jawaban($id_jawaban,$id_pertanyaan){
        if($this->jawaban_model->hapus_jawaban($id_jawaban) == TRUE){
            redirect(base_url().'admin/jawaban/ubah_jawaban/'.$id_pertanyaan);
        }else{
            $this->session->set_flashdata('message','<p class="alert alert-error">Gagal hapus jawaban</p>');
            redirect(base_url().'admin/jawaban/ubah_jawaban/'.$id_pertanyaan);
        }
    }
}
?>
