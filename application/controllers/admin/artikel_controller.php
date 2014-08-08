<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Artikel_Controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('artikel_model','',TRUE);
    }
    
    function index(){
        $data['title'] = 'Admin Page';
        $data['artikel'] = $this->artikel_model->ambil_artikel();
        $komentar = array();
        foreach($this->artikel_model->ambil_komentar() as $comment){
            $komentar[$comment->id_artikel][]=array('komentar'=>$comment->komentar,'date_added'=>$comment->date_added,'author'=>$comment->author);
        }
        $data['komentar'] = $komentar;
        $data['content'] = 'admin/list_artikel';
        $this->load->view('admin/template_admin',$data);
    }
    function tambah(){
        if($this->input->post()){
            $judul = $this->input->post('judul');
            $artikel = $this->input->post('isi_artikel');
            $store2db = array('judul'=>$judul,'isi_artikel'=>$artikel,'date_added'=>date('Y-m-d'),'author'=>$this->session->userdata('adminname'));
            if($this->artikel_model->tambah_artikel($store2db)){
                $this->session->set_flashdata('message','<p class="alert alert-success">Data berhasil ditambah</p>');
                redirect(base_url().'admin/artikel_controller/index');
            }else{
                $this->session->set_flashdata('message','<p class="alert alert-error">Data gagal ditambah</p>');
                redirect(base_url().'admin/artikel_controller/index');
            }
        }
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_artikel';
        $this->load->view('admin/template_admin',$data);
   }
}
?>
