<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Anggota_Controller extends CI_Controller{
    
    public $limit = 1;
    public $offset;
    function __construct() {
        parent::__construct();
        $this->load->model('anggota_model','',TRUE);
        $this->load->model('pinjaman_model','',TRUE);
        $this->load->model('angsuran_model','',TRUE);
    }
    function index($offset=null){
        //sorting and searching proses
        if($this->input->post()){
            $nama_anggota = $this->input->post('nama_anggota');
            $where = array('nama_member'=>$nama_anggota);
        }else{
            $where = null;
        }
        
        //paging configuration
        $config['base_url'] = base_url().'admin/anggota_controller/index/';
        $config['total_rows'] = $this->anggota_model->ambil_total_anggota($where);
        $config['per_page'] = $this->limit;
        $config['uri_segment']= 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        if($offset != null){
            $this->offset = ($offset - 1) * $this->limit;
        }else{
            $this->offset = null;
        }
        //load view daftar anggota
        $data['anggota']=$this->anggota_model->ambil($where,$this->limit,$this->offset);
        $data['title'] = 'Admin Page';
        $data['content']='admin/anggota';
        $this->load->view('admin/template_admin',$data);    
        
        }
    function tambah(){
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_anggota';
        $this->load->view('admin/template_admin',$data);
    }
    function ubah($id_anggota){
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_anggota';
        $this->load->view('admin/template_admin',$data);
    }
    function hapus($id_anggota){
        if($this->anggota_model->hapus($id_anggota)==TRUE){
            redirect(base_url().'admin/anggota_controller');
        }else{
            redirect(base_url().'admin/anggota_controller');
        }
            
    }
    function detail($id_anggota){
        $data['anggota'] = $this->anggota_model->ambil(array('id_member'=>$id_anggota),null,null);
        $data['pinjaman'] = $this->pinjaman_model->ambil(array('id_anggota'=>$id_anggota),null,null);
        $data['angsuran'] = $this->angsuran_model->ambil();
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/detail_anggota';
        $this->load->view('admin/template_admin',$data);
    }
}
?>
