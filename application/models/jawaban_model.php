<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Jawaban_Model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    public function ambil_jawaban(){
        $query = $this->db->get('jawaban');
        return $query->result();
    }
    public function ambil_jawaban_byid($id_pertanyaan){
        $query = $this->db->get_where('jawaban',array('id_pertanyaan'=>$id_pertanyaan));
        return $query->result();
    }
     public function tambah_jawaban($data){
        if($this->db->insert_batch('jawaban',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function ubah_jawaban($data){
        $query = $this->db->update_batch('jawaban',$data,'id_jawaban');
        $this->db->last_query();

    }
    public function hapus_jawaban($id_jawaban){
        $query = $this->db->delete('jawaban',array('id_jawaban'=>$id_jawaban));
        if($query){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>
