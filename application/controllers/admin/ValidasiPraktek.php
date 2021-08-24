<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidasiPraktek extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('praktek_model','course_model'));

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            $this->session->set_flashdata('message_type', 'error');
            $this->session->set_flashdata('messages', 'Please login first.');
            redirect('admin/login');
        }        
    }

    public function index()
    {
        $data['praktek'] = $this->praktek_model->getAllPraktek();
        // print_r($data);
        $this->load->view('admin/validasi_praktek',$data);
    }

    public function beriNilai($idPraktek){
        $praktek = $this->input->post('praktek');
        $getcourse = $this->input->post('getcourse');
        $updateFlag = $this->input->post('updateFlag');
        
        $this->praktek_model->updateNilai($idPraktek, $praktek, 'rzl_praktek');
        $this->course_model->updateFlagByNipIdCourse($getcourse['idcourse'], $getcourse['nip'], $updateFlag, 'rzl_getcourse');//$id, $data, $tabel
        print_r($this->input->post());        
        // echo $a;
    }


}
