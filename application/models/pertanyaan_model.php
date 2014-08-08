<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Pertanyaan_Model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    public function ambil_pertanyaan(){
        $query = $this->db->get('pertanyaan');
        return $query->result();
    }
    public function ambil_pertanyaan_byid($id_pertanyaan){
        $query = $this->db->get_where('pertanyaan',array('id_pertanyaan'=>$id_pertanyaan));
        return $query->row();
    }
    public function tambah_pertanyaan($data){
        if($this->db->insert_batch('pertanyaan',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function set_jawaban($id_pertanyaan,$jawaban){
        $this->db->where('id_pertanyaan',$id_pertanyaan);
        $query = $this->db->update('pertanyaan',array('jawaban'=>$jawaban));
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function ubah_pertanyaan($id_pertanyaan,$data){
        $this->db->where('id_pertanyaan',$id_pertanyaan);
        $query = $this->db->update('pertanyaan',$data);
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function hapus_pertanyaan($id_pertanyaan){
        $query = $this->db->delete('pertanyaan',array('id_pertanyaan'=>$id_pertanyaan));
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function set_spk($data){
        $query = $this->db->update_batch('pertanyaan',$data,'id_pertanyaan');
        $this->db->last_query();
    }
}
?>
