<?php
/*-- file : front-end controller --*/
if(!defined('BASEPATH')) exit('No direct script allowed');

class Index extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Users_Model','',TRUE);
        $this->load->model('Login_Model','',TRUE);
        $this->load->model('Model_Spk','',TRUE);
        $this->load->model('Pertanyaan_Model','',TRUE);
        $this->load->model('Jawaban_Model','',TRUE);
        
    }
    function index(){
        $data['title'] = 'Home Page';
        $this->load->view('template',$data);
    }
     function process_login(){
      
      //get post data
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      
      //set peraturan untuk form validasi
      $this->form_validation->set_rules('username','Username','required|xss_clean');
      $this->form_validation->set_rules('password','Password','required|xss_clean');
      $table = 'users';
     
      //run validation and check user database
      if($this->form_validation->run() == TRUE){
        if($this->Login_Model->cek_user($table,$username,$password) == TRUE){
            $akses = $this->Login_Model->get_hakakses($table,$username, $password);
            $this->session->set_userdata('isUser',TRUE);
            $this->session->set_userdata('username',$akses->username);
            redirect(base_url().'index');
        }
        else{
            $this->session->set_flashdata(array('message'=>'Anda belum terdaftar'));
            $this->session->set_flashdata(array('script'=>"<script>$('.dropdown-toggle').dropdown('toggle');</script>"));
            redirect(base_url().'index');
            
        }
      }
      else{
          $data['title'] = 'Admin Login Page';
          $data['script'] = "<script>$('.dropdown-toggle').dropdown('toggle');</script>";
          $this->load->view('template',$data);
      }
      
    }
     function logout(){
        $this->session->unset_userdata('isUser');
        $this->session->unset_userdata('username');
        redirect(base_url().'index');
    }
/*---------------------------- Create, View, Edit, Delete user member -------------------------------------*/     
    function view_data($parameter,$offset=0){
        if($this->session->userdata('isUser') == TRUE){
        $table = $parameter;
        $total_rows = $this->Users_Model->get_total_data($table);
        $limit = $this->limit;
        if($offset != 0)
            $offset = ($offset - 1) * $limit;
        //load konfigurasi pagination
        $config['base_url'] = base_url().'index/view_data/'.$parameter;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $limit;
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        
        //data yang dipakai di template_admin
        $data['data_db'] = $this->Users_Model->get_data_perpage($table,$limit,$offset);
        $data['title'] = 'User Page';
        $data['content'] = $parameter;  
        $this->load->view('template',$data);
        }else{
            redirect(base_url().'index');
        }
        
    }
    
    function detail_data($table,$id){
      
    }
    
/*-------------------------- Artikel ---------------------------------------------*/
    function artikel(){
        
    }
 /*-----------------------------------------------------------------------------------*/  
    function simulasi(){
        if($this->input->post()){
            $jml_pinjaman = $this->input->post('jml_pinjaman');
            $jangka_wkt = $this->input->post('jangka_wkt');
            $bunga = $this->input->post('bunga');
            $pokok_1 = round($jml_pinjaman / $jangka_wkt);
            $bunga_pokok = 0;
            $total_angsuran = 0;
            $saldo = 0;   
            $simulasi = array();
            for($i=1;$i<=$jangka_wkt;$i++){
                if($i == 1){
                    $saldo = $jml_pinjaman;
                    $pokok = 0;
                }else{
                    $pokok = (int)$pokok_1;
                    $saldo -= $pokok;
                }
                $sisa_saldo = $saldo - $pokok_1;
                $bunga_pokok = $bunga * ($saldo);
                $total_angsuran = $pokok_1 + $bunga_pokok;
                $simulasi[$i]['bulan'] = $i;
                $simulasi[$i]['sisa_pokok'] = number_format($saldo,0,'','.');
                $simulasi[$i]['porsi_pokok'] = number_format($pokok_1,0,'','.');
                $simulasi[$i]['porsi_bunga'] = number_format($bunga_pokok,0,'','.');
                $simulasi[$i]['jml_cicilan'] = number_format($total_angsuran,0,'','.');
                $simulasi[$i]['saldo'] = number_format($sisa_saldo,0,'','.');
                
            }
            $data['simulasi'] = $simulasi;
        }
        $data['title'] = 'Home Page';
        $data['content'] = 'simulasi';
        $this->load->view('template',$data);
        
    }
    function spk(){
        $spkdb = $this->Model_Spk->get_default_attribute();
        $pertdb= $this->Pertanyaan_Model->ambil_pertanyaan();
        $piljwdb = $this->Jawaban_Model->ambil_jawaban();
        $datap = array();
        $datapj = array();
        foreach($pertdb as $p){
            $datap[$p->id_pertanyaan]['pertanyaan']= $p->pertanyaan;
            $datap[$p->id_pertanyaan]['jawaban']= $p->jawaban;
        }
        foreach($piljwdb as $j){
            $datapj[$j->id_pertanyaan][] = $j->pilihan_jawaban;
        }
//        print_r($datap);
//        print_r($datapj);
        $spk = explode(',', $spkdb->atribut);
        if($this->input->post()){
            if($this->decision() == 'disetujui'){
                $message = '<p>Silahkan persiapkan KK</p>';
            }
            else{
                $message = '<p>Maaf, anda belum memenudhi persyaratan</p>';
            }
                
           $data['result'] = $this->decision().$message;
        }
        $data['spk']=$spk;
        $data['id_atribut'] = $spkdb->id_atribut;
        $data['pertanyaan'] = $datap;
        $data['jawaban'] = $datapj;
        $data['title'] = 'Home Page';
        $data['content'] = 'pertanyaan';
        $this->load->view('template',$data);
    }
    function decision(){
//       print_r($this->input->post());
        $count = count($this->input->post('jawaban'));
        $jawaban =$this->input->post('jawaban');
        $pil_jawaban = $this->input->post('pil_jawaban');
        $id_atribut = $this->input->post('id_atribut');
        $analisa = '';
        for($i=0;$i<$count;$i++){
            if($jawaban[$i] == $pil_jawaban[$i] ){
                $analisa .= 'true,';
            }else{
                $analisa .= 'false,';
            }
        }
        $analisa = rtrim($analisa, ',');
        $rule = $this->Model_Spk->get_rule($id_atribut);
        $result = '';
        foreach ($rule as $r){
            if($r->rule == $analisa){
                $result =  $r->result;
                break;
            }
        }
        
        return $result;
//        $data['title'] = 'Home Page';
//        $data['content'] = 'pertanyaan';
//        $this->load->view('template',$data);
    }
}
?>
