<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Artikel_Model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function ambil_artikel($where=null){
        $this->db->select('*');
        $this->db->from('artikel');
        if(!empty($where)){
            $this->db->where($where);
        }
        $query = $this->db->get();
        return $query->result();
    }
   
    function tambah_artikel($data){
        if($this->db->insert('artikel',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
     function ambil_komentar($where=null){
        $this->db->select('*');
        $this->db->from('komentar');
         if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->order_by('id_komentar','desc');
        $query = $this->db->get();
        return $query->result();
    }
    
    function tambah_komentar($data){
        if($this->db->insert('komentar',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>
