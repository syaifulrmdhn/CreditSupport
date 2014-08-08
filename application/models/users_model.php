<?php
class Users_Model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    function get_all_user($q=null){
        $this->db->select('username AS id,username AS name');
        $this->db->like('username', $q);
        $result = $this->db->get('users');
        $datas = $result->result_array();
//        $username = array();
//        foreach($datas as $data){
//            $username[] = $data->username;
//        }
//        return $username;
        return $datas;
    }
    function get_total_data($table){
        $result = $this->db->get($table);
        return $result->num_rows();
    }
    function get_data_perpage($table,$limit,$offset){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->limit($limit,$offset);
        $this->db->order_by('id_'.$table,'asc');
        $result = $this->db->get();
        return $result->result();
    }
    function get_detail_data($table,$id){
        $this->db->select('*');
        $result = $this->db->get_where($table,array('id_'.$table=>$id));
        return $result->row();
    }
    
    function update_data($table,$data,$id){
        echo 'update';
        echo $table;
        $this->db->where('id_'.$table,$id);
        if($this->db->update($table,$data))
                return TRUE;
        else
            return FALSE;
    }
    function delete_data($table,$id){
        if ($this->db->delete($table,array('id_'.$table=>$id))){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function add_new_data($table,$data){
        if($this->db->insert($table,$data))
                return TRUE;
        else 
            return FALSE;
    }
/*--------------------MESSAGE RELATED FUNCTIONS-------------------------------*/    
    function send_message($table,$data){
        if($this->db->insert($table,$data))
                return TRUE;
        else
            return FALSE;
    }
    function to_outbox($data){
        if($this->db->insert('outbox',$data))
            return TRUE;
        else
            return FALSE;
    }
    function get_unread_message($username){
        $this->db->select('*');
        $this->db->from('inbox');
        $this->db->like('to',$username);
        $this->db->where('viewed',0);
        $result = $this->db->get();
        $total = $result->num_rows();
        return $total;
    }
    function get_all_inbox($username){
        $this->db->select('*');
        $this->db->from('inbox');
        $this->db->like('to',$username);
        $this->db->order_by('date','desc');
        $result = $this->db->get();
        return $result->result();
    }
    function get_all_outbox($username){
        $this->db->select('*');
        $this->db->from('outbox');
        $this->db->where('from',$username);
        $this->db->order_by('date','desc');
        $result = $this->db->get();
        return $result->result();
    }
    function get_message($id){
        $this->db->where('id',$id);
        $data = array('viewed'=>1);
        $this->db->update('inbox',$data);
        $result = $this->db->get_where('inbox',array('id'=>$id));
        return $result->row();
    }
    function delete_message($id){
        if(is_array($id)){
            foreach($id as $key){
                $this->db->delete('inbox',array('id'=>$key));
            }
        }
        else{
            $this->db->delete('inbox',array('id'=>$id));
        }
    }
}
?>
