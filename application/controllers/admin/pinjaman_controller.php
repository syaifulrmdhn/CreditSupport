<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Pinjaman_Controller extends CI_Controller{
    
    public $limit = 10;
    public $offset;
    function __construct() {
        parent::__construct();
        $this->load->model('pinjaman_model','',TRUE);
        $this->load->model('anggota_model','',TRUE);
    }
    function index($offset=null){
        if($offset == null)
            $this->offset = 0;
        else
            $this->offset = ($offset - 1)*$this->limit;
        
        //if search submit
        if($this->input->post()){
            $keyword = $this->input->post('keyword');
            $category = $this->input->post('category');
            $where = array($category=>$keyword);
        }else{
           $where = null; 
        }
        //konfigurasi paging
        $config['base_url']= base_url().'admin/pinjaman_controller/index';
        $config['total_rows']=$this->pinjaman_model->ambil_total($where);
        $config['per_page']=$this->limit;
        $config['uri_segment']=4;
        $config['use_page_numbers']=TRUE;
        $this->pagination->initialize($config);
        //ambil semua data
        $data['pinjaman'] = $this->pinjaman_model->ambil($where,  $this->limit,$this->offset);
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/pinjaman';
        $this->load->view('admin/template_admin',$data);
    }
    function tambah_pinjaman(){
        if($this->input->post()){
            $store2db = array('bunga'=>$this->input->post('bunga'),
                'tgl_pinjaman'=>$this->input->post('tgl_pinjaman'),
                'total_pinjaman'=>$this->input->post('jml_pinjaman'),
                'id_anggota'=>$this->input->post('id_anggota'),
                'jangka_waktu'=>$this->input->post('jangka_waktu'));
            if($this->pinjaman_model->tambah($store2db) == TRUE){
                $this->session->set_flashdata('message','<p class="alert alert-success">Data berhasil ditambah</p>');
                redirect(base_url().'admin/pinjaman_controller');
            }
            else{
               $this->session->set_flashdata('message','<p class="alert alert-error">Data gagal ditambah</p>');
                redirect(base_url().'admin/pinjaman_controller'); 
            }
        }
        $anggotadb = $this->anggota_model->ambil_nama_anggota();
        $anggota = '[';
        foreach($anggotadb as $a){
            $anggota .= "'".$a->nama_member."',";
        }
        $anggota = rtrim($anggota, ',');
        $anggota .= ']';
        $data['anggota']= $anggota;
        $data['content'] = 'admin/form_pinjaman';
        $data['title'] = 'Admin Page';
        $this->load->view('admin/template_admin',$data);
    }
    function ambil_id_anggota(){
        $nama_anggota = $this->input->post('nama_anggota');
        $id_anggota = $this->anggota_model->ambil_id_anggota($nama_anggota);
        echo json_encode(array('id'=>$id_anggota));
    }
    function ubah_pinjaman($id_pinjaman){
        if($this->input->post()){
            $store2db = array('bunga'=>$this->input->post('bunga'),
                'tgl_pinjaman'=>$this->input->post('tgl_pinjaman'),
                'total_pinjaman'=>$this->input->post('jml_pinjaman'),
                'id_anggota'=>$this->input->post('id_anggota'),
                'jangka_waktu'=>$this->input->post('jangka_waktu'));
            if($this->pinjaman_model->ubah($id_pinjaman,$store2db) == TRUE){
                $this->session->set_flashdata('message','<p class="alert alert-success">Data berhasil diubah</p>');
                redirect(base_url().'admin/pinjaman_controller');
            }
            else{
               $this->session->set_flashdata('message','<p class="alert alert-error">Data gagal diubah</p>');
                redirect(base_url().'admin/pinjaman_controller'); 
            }
        }
        $anggotadb = $this->anggota_model->ambil_nama_anggota();
        $anggota = '[';
        foreach($anggotadb as $a){
            $anggota .= "'".$a->nama_member."',";
        }
        $anggota = rtrim($anggota, ',');
        $anggota .= ']';
        $data['anggota']= $anggota;
        $data['id_pinjaman']=$id_pinjaman;
        $data['pinjaman'] = $this->pinjaman_model->ambil(array('pinjaman.id_pinjaman'=>$id_pinjaman),null,null);
        $data['content'] = 'admin/form_pinjaman';
        $data['title'] = 'Admin Page';
        $this->load->view('admin/template_admin',$data);
    }
    function hapus_pinjaman($id_pinjaman){
     if($this->pinjaman_model->hapus($id_pinjaman) == TRUE){
                $this->session->set_flashdata('message','<p class="alert alert-success">Data berhasil dihapus</p>');
                redirect(base_url().'admin/pinjaman_controller');
            }
            else{
               $this->session->set_flashdata('message','<p class="alert alert-error">Data gagal dihapus</p>');
                redirect(base_url().'admin/pinjaman_controller'); 
            }   
    }
}
?>
