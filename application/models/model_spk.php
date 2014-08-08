<?php
if(!defined('BASEPATH')) exit('No direct access allowed');
class Model_Spk extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function set_default($id_atribut){
        $this->db->update('atribut',array('set_as'=>''));
        $this->db->where('id_atribut',$id_atribut);
        $this->db->update('atribut',array('set_as'=>'default'));
    }
    function set_atribut($data){
        $query = $this->db->get_where('atribut',array('atribut'=>$data['atribut']));
        if($query->num_rows() > 0){
            return FALSE;
        }else{
            if($this->db->insert('atribut',$data))
                return TRUE;
            else
                return FALSE;
        }
    }
    function get_default_attribute(){
        $query = $this->db->get_where('atribut',array('set_as'=>'default'));
        return $query->row();
    }
    function get_all_attributes(){
        $query = $this->db->get('atribut');
        return $query->result();
    }
    function get_atribut($id){
        $query = $this->db->get_where('atribut',array('id_atribut'=>$id));
        return $query->row();
    }
    function add_newatribut($data){
        if($this->db->insert('atribut',$data)){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function update_atribut($data,$id){
   
        $this->db->where('id_atribut',$id);
        if($this->db->update('atribut',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function delete_atribut($id){
        if($this->db->delete('atribut',array('id_atribut'=>$id))){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function add_newrule($data){
        if($this->db->insert('rule',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
                
    }
    function get_rule($id_atribut){
        $result = $this->db->get_where('rule',array('id_atribut'=>$id_atribut));
        if($result->num_rows()>0){
            return $result->result();
        }
        else{
            return null;
        }
    }
    function update_rule($id,$data){
        $this->db->where('id',$id);
        if($this->db->update('rule',$data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function delete_rule($id_rule){
        if($this->db->delete('rule',array('id'=>$id_rule))){
            return TRUE;
        }
        else {
            return FALSE;
            }
    }
//    function get_all_decision(){
//        $query = $this->db->get('decision');
//        return $query->result();
//    }
//    function add_decision($data){
//       if($this->db->insert('decision',$data))
//           return TRUE;
//       else
//           return FALSE;
//    }
    
}
?>
