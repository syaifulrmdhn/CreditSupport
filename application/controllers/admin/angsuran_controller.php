<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Angsuran_Controller extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('pinjaman_model','',TRUE);
        $this->load->model('angsuran_model','',TRUE);
    }
    function index($offset=null){
        
    }
    function ambil(){
        
    }
    function tambah(){
        
    }
    function ubah($id_angsuran=null){
        
    }
    function hapus($id_angsuran=null){
        
    }
}
?>
