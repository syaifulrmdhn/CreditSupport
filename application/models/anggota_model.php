<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Anggota_Model extends CI_Model{

    function __construct() {
        parent::__construct();
    }
    function ambil_nama_anggota(){
        $this->db->select('nama_member,id_member');
        $this->db->from('member');
        $query = $this->db->get();
        return $query->result();
    }
    function ambil_id_anggota($nama_anggota){
        $query = $this->db->get_where('member',array('nama_member'=>$nama_anggota));
        return $query->row()->id_member;
    }
    function ambil($where=null,$limit=null,$offset=null){
        $this->db->select('*');
        $this->db->from('member');
        if($where != null)
           $this->db->like($where);
        if($limit != null & $offset != null)
            $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result();
    }
    function ambil_total_anggota($where=null){
        $this->db->select('*');
        $this->db->from('member');
        if($where != null)
            $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function ubah(){
        
    }
    function hapus(){
        
    }
}
?>
