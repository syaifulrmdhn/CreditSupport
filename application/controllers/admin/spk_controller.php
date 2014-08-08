<?php
if(!defined('BASEPATH')) exit('No direct script allowed');
class Spk_Controller extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('model_spk','',TRUE);
        $this->load->model('pertanyaan_model','',TRUE);
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
            redirect(base_url().'admin/pertanyaan');
        }else{
            $this->session->set_flashdata('message','<p class="alert alert-success">Kombinasi sudah diset /tidak ada perubahan</p>');
            redirect(base_url().'admin/pertanyaan');
        }
    }
}
?>
