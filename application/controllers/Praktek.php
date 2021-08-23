<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Praktek extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('praktek_model'));

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            $this->session->set_flashdata('message_type', 'error');
            $this->session->set_flashdata('messages', 'Please login first.');
            redirect('admin/login');
        }        
    }

    // public function index($id)
    // {
    //     echo "sdsd";
    // }

    public function cekQuota(){
        $quota = $this->input->post();
        $cekPeserta = $this->praktek_model->cekQuotaPraktek($quota['idcourse'],$quota['tglpraktek']);
        echo $cekPeserta[0]['terisi'];
    }     

    public function printBuktiDaftar($idCourse)
    {
        $data['praktek'] = $this->praktek_model->getPraktek($this->session->userdata('nip'),$idCourse);
        $this->load->view('printBuktiDaftar',$data);
    }       
    
    public function saveData()
    {
        $data = $this->input->post('praktek');
        $this->praktek_model->saveData($data, 'rzl_praktek');
        print_r($this->input->post());
    }    


}
