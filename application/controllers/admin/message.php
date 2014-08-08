<?php
if(!defined('BASEPATH')) exit('No direct script allowed');

class Message extends CI_Controller{
    var $limit = 5;
    function __construct() {
        parent::__construct();
        $this->load->model('Users_Model','',TRUE);
    }
    function index($offset=null){
        $name = $this->session->userdata('adminname');
        $limit = $this->limit;
        $inbox = $this->Users_Model->get_all_inbox($name,$limit,$offset);
        $total_row = count($inbox);
         if($offset != null)
            $offset = ($offset - 1) * $limit;
        /*---- Configure paging -----*/
        $config['base_url'] = base_url().'admin/message/index';
        $config['total_rows'] = $total_row;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        /*---- Set data for view ----*/
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/private_message';
        $data['inbox_total'] = $this->Users_Model->get_unread_message($name);
        $users = $this->Users_Model->get_all_user();
        $dat = '[';
        foreach($users as $username ) {
            $dat .= "'".$username."',";
        }
        $dat .= "]";
        $data['messages'] = $inbox;
        $data['msg_content'] = 'admin/inbox';
        $data['script'] = '<script>  
                         var subjects ='.$dat.';'.
                         "$('#sendto').typeahead({source: subjects})  
                         </script>";
        $this->load->view('admin/template_admin',$data);
    }
    function inbox($offset=null){
           $name = $this->session->userdata('adminname');
        $limit = $this->limit;
        $inbox = $this->Users_Model->get_all_inbox($name,$limit,$offset);
        $total_row = count($inbox);
         if($offset != null)
            $offset = ($offset - 1) * $limit;
        /*---- Configure paging -----*/
        $config['base_url'] = base_url().'admin/message/index';
        $config['total_rows'] = $total_row;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        /*---- Set data for view ----*/
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/private_message';
        $data['inbox_total'] = $this->Users_Model->get_unread_message($name);
        $users = $this->Users_Model->get_all_user();
        $dat = '[';
        foreach($users as $username ) {
            $dat .= "'".$username."',";
        }
        $dat .= "]";
        $data['messages'] = $inbox;
        $data['msg_content'] = 'admin/inbox';
        $data['script'] = '<script>  
                         var subjects ='.$dat.';'.
                         "$('#sendto').typeahead({source: subjects})  
                         </script>";
        $this->load->view('admin/template_admin',$data);
    }
    function outbox($offset=null){
        $name = $this->session->userdata('adminname');
        $limit = $this->limit;
        $outbox = $this->Users_Model->get_all_outbox($name,$limit,$offset);
        $total_row = count($outbox);
         if($offset != null)
            $offset = ($offset - 1) * $limit;
        /*---- Configure paging -----*/
        $config['base_url'] = base_url().'admin/message/index';
        $config['total_rows'] = $total_row;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        /*---- Set data for view ----*/
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/private_message'; //header navigasi inbox, outbox, compose
        $data['inbox_total'] = '';
        $users = $this->Users_Model->get_all_user();
        $dat = '[';
        foreach($users as $username ) {
            $dat .= "'".$username."',";
        }
        $dat .= "]";
        $data['messages'] = $outbox;
        $data['msg_content'] = 'admin/outbox';
        $this->load->view('admin/template_admin',$data);
    }
    function compose(){
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/private_message';
        $name = $this->session->userdata('adminname');
        $data['inbox_total'] = $this->Users_Model->get_unread_message($name);
        $users = $this->Users_Model->get_all_user();
        $dat = '[';
        foreach($users as $username ) {
            $dat .= "'".$username."',";
        }
        $dat .= "]";
        $data['msg_content'] = 'admin/compose';
//        $data['script'] = '<script>  
//                         var subjects ='.$dat.';'.
//                         "$('#sendto').typeahead({
//                             mode: 'multiple', delimiter: ';', source: subjects,})  
//                         </script>";
        $this->load->view('admin/template_admin',$data);
    }
    function view_inbox($id_msg){
        //kalau utk multiple user ambil message utk diri sendiri?
        $id = $id_msg;
        //update viewed message on db
        $msg_detail = $this->Users_Model->get_message($id);
        $name = $this->session->userdata('adminname');
        $data['title'] = 'Admin Page';
        $data['inbox_total'] = $this->Users_Model->get_unread_message($name);
        $data['content'] = 'admin/private_message';
        $data['msg_content'] = 'admin/inbox';
        $data['msg_detail'] = $msg_detail;
        $tglArtikel = date("Y-m-d H:i:s");
        $this->load->view('admin/template_admin',$data);
    }
    function reply_to_all($id_msg){
        $id = $id_msg;
        //update viewed message on db
        $name = $this->session->userdata('adminname');
        $data['inbox_total'] = $this->Users_Model->get_unread_message($name);
        $msg_detail = $this->Users_Model->get_message($id);
        $name = $this->session->userdata('adminname');
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/private_message';
        $data['msg_content'] = 'admin/reply2all';
        $data['msg_detail'] = $msg_detail;
        $this->load->view('admin/template_admin',$data);
    }
    function view_outbox($id_msg){
        //klo multiple user, spt reply all?
        $id = $id_msg;
        //update viewed message on db
        $msg_detail = $this->Users_Model->get_message($id);
        $name = $this->session->userdata('adminname');
        $data['title'] = 'Admin Page';
        $data['inbox_total'] = $this->Users_Model->get_unread_message($name);
        $data['content'] = 'admin/private_message';
        $data['msg_content'] = 'admin/inbox';
        $data['msg_detail'] = $msg_detail;
        $this->load->view('admin/template_admin',$data);
    }
    function send_message(){
        $sendto = $this->input->post('receiver');
        $subject = $this->input->post('subject');
        $body = $this->input->post('some-text');
        $from = $this->session->userdata('adminname');
        $data =  array('from'=>$from,'to'=>$sendto,
            'date'=>date("Y-m-d H:i:s"),'subject'=>$subject,'body'=>$body,'viewed'=>0);
        if($this->Users_Model->send_message('inbox',$data)){
            $this->Users_Model->to_outbox($data);
            $this->session->set_flashdata('success','Message successfully sent');
            redirect (base_url().'admin/message');
        }
        else{
            $this->session->set_flashdata('error','Sending message failed');
            redirect (base_url().'admin/message');
        }
    }
    function delete_inbox($id=null){
        $id = $id;
        if($id != null)
            $id_msg = $id;
        else
            $id_msg = $this->input->post('delete_msg');
        $this->Users_Model->delete_message($id_msg);
        redirect (base_url().'admin/message/inbox');
    }
      function delete_outbox($id=null){
        $id = $id;
        if($id != null)
            $id_msg = $id;
        else
            $id_msg = $this->input->post('delete_msg');
        $this->Users_Model->delete_message($id_msg);
        redirect (base_url().'admin/message/outbox');
    } 
    function get_all_user(){
        $q = $_GET['q'];
        $users = $this->Users_Model->get_all_user($q);
//        $data = array();
//        foreach($users as $user){
//            $data[] = array('name'=>$user);
//        }
        //print_r($data);
//        if($_GET["callback"]) {
//            $json_response = $_GET["callback"] . "(" . $json_response . ")";
//        }

        # Return the response
        $json_response = json_encode($users);
        echo $json_response;
   }
}
?>
