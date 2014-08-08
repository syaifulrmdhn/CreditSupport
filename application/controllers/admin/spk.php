<?php
if(!defined('BASEPATH')) exit('No direct script allowed');
class Spk extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->Model('model_spk','',TRUE);
        $this->load->model('pertanyaan_model','',TRUE);
    }
    
    function index(){
        //get database pertanyaan
        $data['atributes'] = $this->model_spk->get_all_decision();
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/pertanyaan';
        $this->load->view('admin/template_admin',$data);
    }
    function set_rule(){
        $pertanyaan = $this->input->post('pertanyaan');
        //set as_spk di pertanyaan brdsrkan pertanyaan yg dipilih
        $store2db = array();
        $i = 0;
        foreach($pertanyaan as $p){
            $store2db[$i]['id_pertanyaan'] = $p;
            $store2db[$i]['as_spk'] = 1;    
            $i++;
        }
        $atribut = array('atribut'=>  implode(',', $pertanyaan),'total_atribut'=>count($pertanyaan));
        $this->pertanyaan_model->set_spk($store2db);
        //insert ke atribut brdsrkn selected pertanyaan, total atribut
        if($this->model_spk->set_atribut($atribut) == TRUE){
            $this->session->set_flashdata('message','<p class="alert alert-success">Berhasil di set</p>');
//            redirect(base_url().'admin/pertanyaan');
        }else{
            $this->session->set_flashdata('message','<p class="alert alert-success">Kombinasi sudah diset /tidak ada perubahan</p>');
//            redirect(base_url().'admin/pertanyaan');
        }
    }
    function setdefault_atribut($id_atribut){
        $this->model_spk->set_default($id_atribut);
        redirect(base_url().'admin/spk/atribut');
    }
    function atribut(){
        //list pertanyaan yg ada dan tombol tambah 
        //ambil data pertanyaan
        $atribut = $this->model_spk->get_all_attributes();
        $data['atribut'] = $atribut;
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/atribut';
        $this->load->view('admin/template_admin',$data);
    }
    function add_atribut(){
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_createatribut';
        $this->load->view('admin/template_admin',$data);
    }
    function create_newatribut(){
        $atribut = $this->input->post('atribut');
        $pertanyaan = $this->input->post('pertanyaan');
        $jawaban = $this->input->post('jawaban');
        $store2db = array('atribut'=>implode(',',$atribut),
                'pertanyaan'=>  implode(',', $pertanyaan),
                'jawaban'=>  implode(',', $jawaban),
                'total_atribut'=>count($atribut));
        if($this->model_spk->add_newatribut($store2db) == TRUE){
            $this->session->set_flashdata(array('message'=>'<span class="alert alert-success">Atribut berhasil ditambah</span>'));
            redirect(base_url().'admin/spk/atribut');
        }
        else{
            $this->session->set_flashdata(array('message'=>'<span class="alert alert-error">Atribut gagal ditambah</span>'));
            redirect(base_url().'admin/spk/atribut');
        }
    }
    function edit_atribut($id_atribut){
        $atribut = $this->model_spk->get_atribut($id_atribut);
        $data['id'] = $id_atribut;
        $data['spk'] = $atribut;
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/form_editatribut';
        $this->load->view('admin/template_admin',$data);
    }
    function update_atribut(){
        $id_atribut = $this->input->post('id_atribut');
        $atribut = $this->input->post('atribut');
        $pertanyaan = $this->input->post('pertanyaan');
        $jawaban = $this->input->post('jawaban');
        $count = count($atribut);
        $store2db = array('atribut'=>  implode(',', $atribut),
            'pertanyaan'=>  implode(',', $pertanyaan),
            'jawaban'=>  implode(',', $jawaban),
            'total_atribut'=>$count);
        if($this->model_spk->update_atribut($store2db,$id_atribut) == TRUE){
            $this->session->set_flashdata(array('message'=>'<span class="alert alert-success">Atribut berhasil dirubah</span>'));
            redirect(base_url().'admin/spk/atribut');
        }
        else{
            $this->session->set_flashdata(array('message'=>'<span class="alert alert-error">Atribut gagal dirubah</span>'));
            redirect(base_url().'admin/spk/atribut');
        }
    }
    function delete_atribut($id_atribut){
        if($this->model_spk->delete_atribut($id_atribut) == TRUE){
            $this->session->set_flashdata(array('message'=>'<span class="alert alert-success">Atribut berhasil dihapus</span>'));
            redirect(base_url().'admin/spk/atribut');
        }else{
            $this->session->set_flashdata(array('message'=>'<span class="alert alert-error">Atribut gagal dihapus</span>'));
            redirect(base_url().'admin/spk/atribut');
        }
    }
    function rule(){
        //list rule yg ada dan tomol tambah,ubbah,hapus
    }
    function edit_rule($id_atribut){
        $data['id_atribut'] = $id_atribut;
        $data['atribut'] = $this->model_spk->get_atribut($id_atribut);
        $fromdb = $this->pertanyaan_model->ambil_pertanyaan();
        $per_jwb = array();
        foreach($fromdb as $p){
            $per_jwb[$p->id_pertanyaan] = $p->pertanyaan.' '.$p->jawaban;
        }
        $data['pertanyaan'] = $per_jwb;
        $data['rules'] = $this->model_spk->get_rule($id_atribut);
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/rule';
        $this->load->view('admin/template_admin',$data);
    }
    function add_rule($id_atribut){
        $data['id_atribut'] = $id_atribut;
        $data['atribut'] = $this->model_spk->get_atribut($id_atribut);
        $fromdb = $this->pertanyaan_model->ambil_pertanyaan();
        $per_jwb = array();
        foreach($fromdb as $p){
            $per_jwb[$p->id_pertanyaan] = $p->pertanyaan.' '.$p->jawaban;
        }
        $data['pertanyaan'] = $per_jwb;
        $data['rule'] = $this->model_spk->get_rule($id_atribut);
        $data['title'] = 'Admin Page';
        $data['content'] = 'admin/add_rule';
        $this->load->view('admin/template_admin',$data);
    }
    function create_rule(){
        $id_atribut = $this->input->post('id_atribut');
        $rules=$this->input->post('rules');
        $result= $this->input->post('result');
        $arr = array();
        $arr2 = array();
        $flag = TRUE;
        foreach( $rules as $rule ){
            $arr[]['rule'] =implode(',', $rule);
            //true,true,true,true
        }
        foreach($result as $res){
            $arr2[]['result']=$res;
        }
        for($i=0;$i<count($arr);$i++){
            $combine[] = $arr[$i]+$arr2[$i];
        }
        foreach($combine as $newarr){
            echo $newarr['rule'].', '.$newarr['result'].'<br>';
            $data = array('id_atribut'=>$id_atribut,
                'rule'=>$newarr['rule'],
                'result'=>$newarr['result']);
            if($this->model_spk->add_newrule($data) == TRUE)
                $flag = TRUE;
            else {
                $flag = FALSE;
                break;
            }
        }
        if($flag == TRUE){
            $this->session->set_flashdata('message','<p class="alert alert-success">Rule berhasil ditambah</p>');
            redirect(base_url().'admin/spk/atribut');
        }
        else{
           $this->session->set_flashdata('message','<p class="alert alert-error">Rule gagal ditambah</p>');
           redirect(base_url().'admin/spk/atribut'); 
        }
    }
    function update_rule(){
        $id_atribut = $this->input->post('id_atribut');
        $rules=$this->input->post('rules');
        $result= $this->input->post('result');
        $id_rule = $this->input->post('id_rule');
        $arr = array();
        $arr2 = array();
        $arr3 = array();
        $flag = TRUE;
        foreach( $rules as $rule ){
            $arr[]['rule'] =implode(',', $rule);
            //true,true,true,true
        }
        foreach($result as $res){
            $arr2[]['result']=$res;
        }
        foreach($id_rule as $id){
            $arr3[]['id_rule']=$id;
        }
        for($i=0;$i<count($arr);$i++){
            $combine[] = $arr[$i]+$arr2[$i]+$arr3[$i];
        }
        foreach($combine as $newarr){
            $data = array('id_atribut'=>$id_atribut,
                'rule'=>$newarr['rule'],
                'result'=>$newarr['result']);
            if($this->model_spk->update_rule($newarr['id_rule'],$data) == TRUE)
                $flag = TRUE;
            else {
                $flag = FALSE;
                break;
            }
        }
        if($flag == TRUE){
            $this->session->set_flashdata('message','<p class="alert alert-success">Rule berhasil dirubah</p>');
            redirect(base_url().'admin/spk/atribut');
        }
        else{
           $this->session->set_flashdata('message','<p class="alert alert-error">Rule gagal dirubah</p>');
           redirect(base_url().'admin/spk/atribut'); 
        }
    }
    function delete_rule($id_rule,$id_atribut){
        if($this->model_spk->delete_rule($id_rule) == TRUE) {
            $this->session->set_flashdata('message','<p class="alert alert-success">Rule berhasil dihapus</p>');
            redirect(base_url().'admin/spk/edit_rule/'.$id_atribut);
        }else{
            $this->session->set_flashdata('message','<p class="alert alert-success">Rule gagal dihapus</p>');
            redirect(base_url().'admin/spk/edit_rule/'.$id_atribut);
        }
    }
//   public function set_rule(){
//        $data['title'] = 'Admin Page';
//        $this->load->view('admin/template_admin',$data);
//   }
}
?>
