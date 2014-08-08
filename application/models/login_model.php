<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Login_Model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function test(){
        echo 'login_model';
    }
    function cek_user($table,$username, $password){
        $this->db->select('*');
        $query = $this->db->get_where($table,array('username'=>$username,'password'=>  md5($password)));
        //$query = "SELECT * FROM admin WHERE username='$username' AND password=MD5('$password')";
        //$result = $this->db->query($query);
         $result = $query->num_rows();
        if($result == 1){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function get_hakakses($table, $username, $password){
        $this->db->select('*');
        $query = $this->db->get_where($table,array('username'=>$username,'password'=>  md5($password)));
        $result = $query->row();
//        $hakakses = $result->hak_akses;
//        return $hakakses;
        return $result;
    }
}
?>
