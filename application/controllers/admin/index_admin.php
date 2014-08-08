<?php
/*-- file : back-end Admin controller --*/
if(!defined('BASEPATH')) exit('No direct script allowed');

class Index_Admin extends CI_Controller{
    var $limit = 5;
    function __construct() {
        parent::__construct();
        $this->load->model('Users_Model','',TRUE);
        $this->load->model('Login_Model','',TRUE);
    }
    function index(){
        $data['title'] = 'Admin Page';
        $this->load->view('admin/template_admin',$data);
    }

/*---------------------------- Create, View, Edit, Delete user member -------------------------------------*/     
    function view_data($parameter,$offset=0){
        if($this->session->userdata('isAdmin') == TRUE){
        $table = $parameter;
        $total_rows = $this->Users_Model->get_total_data($table);
        $limit = $this->limit;
        if($offset != 0)
            $offset = ($offset - 1) * $limit;
        //load konfigurasi pagination
        $config['base_url'] = base_url().'admin/index_admin/view_data/'.$parameter;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        
        //data yang dipakai di template_admin
        $data['data_db'] = $this->Users_Model->get_data_perpage($table,$limit,$offset);
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/'.$parameter;  
        $this->load->view('admin/template_admin',$data);
        }else{
            redirect(base_url().'admin/index_admin');
        }
        
    }
    function create_data(){
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/add_pegawai';
        $this->load->view('admin/template_admin',$data);
    }
    function add_data(){
        $name = $this->input->post('nama');
        $table = $this->input->post('table');
        $data = array('nama'=>$name);
        if($this->Users_Model->add_new_data($table,$data) == TRUE){
            $page = ceil($this->Users_Model->get_total_data($table)/$this->limit);
            $this->session->set_flashdata('success','Data sukses ditambah');
            redirect(base_url ().'admin/index_admin/view_data/'.$table.'/'.$page);
        }
        else{
            $this->session->set_flashdata('success','Data gagal ditambah');
            redirect(base_url ().'admin/index_admin/view_data/'.$table);
        }
    }
    function detail_data($table,$id){
        echo $table;
        $data['title'] = 'Admin Page';
        $data['details'] = $this->Users_Model->get_detail_data($table,$id);
        $data['content'] = 'admin/'.$table.'_detail';
        $this->load->view('admin/template_admin',$data);
    }
    
    function edit_data($table,$id){
        $data['title'] = 'Admin Page';
        $data['details'] = $this->Users_Model->get_detail_data($table,$id);
        $data['content'] = 'admin/'.$table.'_edit';
        $this->load->view('admin/template_admin',$data);
    }
    function save_data(){
        $id = $this->input->post('id');
        echo $nama = $this->input->post('nama');
        echo $table = $this->input->post('table');
        $data = array('nama'=>$nama);        
        if($this->Users_Model->update_data($table,$data,$id) == TRUE){
            $this->session->set_flashdata('success','Data sukses terupdate');
            redirect(base_url ().'admin/index_admin/edit_data/'.$table.'/'.$id);
        }else{
            $this->session->set_flashdata('error','Data gagal diupdate');
            redirect(base_url ().'admin/index_admin/edit_data/'.$table.'/'.$id);
       
        }
    }
    function delete_data($table,$id_pegawai){
        if($this->Users_Model->delete_data($table,$id_pegawai) == TRUE){
             $this->session->set_flashdata('success','Data telah sukses dihapus');
             redirect(base_url ().'admin/index_admin/view_data/'.$table);
        }
        else{
            $this->session->set_flashdata('error','Data gagal dihapus');
             redirect(base_url ().'admin/index_admin/view_data/'.$table);
        }
    }
/*-------------------------- Artikel ---------------------------------------------*/
    function artikel(){
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/artikel';
        $this->load->view('admin/template_admin',$data);
    }
}
?>
