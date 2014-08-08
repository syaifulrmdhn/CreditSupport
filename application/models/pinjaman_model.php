<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Pinjaman_Model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function ambil($where=null,$limit=null,$offset=null){
        $this->db->select('*');
        $this->db->from('pinjaman');
        $this->db->join('member','pinjaman.id_anggota = member.id_member');
        if($where != null)
           $this->db->like($where);
        if($limit != null & $offset != null)
            $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result();
    }
    function ambil_total($where=null){
        $this->db->select('*');
        $this->db->from('pinjaman');
        $this->db->join('member','pinjaman.id_anggota = member.id_member');
        if($where != null)
            $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
  
    function tambah($data){
        if($this->db->insert('pinjaman',$data))
            return TRUE;
        else
            return FALSE;
        
    }
    function ubah($id_pinjaman,$data){
        $this->db->where('id_pinjaman',$id_pinjaman);
        $query = $this->db->update('pinjaman',$data);
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function hapus($id_pinjaman){
     $query = $this->db->delete('pinjaman',array('id_pinjaman'=>$id_pinjaman));   
     if($query){
         return TRUE;
     }else{
         return FALSE;
     }
    }
}
?>
