<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidasiPraktek extends CI_Controller
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

    public function index()
    {
        $data['praktek'] = $this->praktek_model->getAllPraktek();
        // print_r($data);
        $this->load->view('admin/validasi_praktek',$data);
    }

    // public function approved($idData)
    // {
    //     $competency = $this->input->post('competency');
    //     $this->competency_model->updateCompetency($idData, $competency, 'rzl_m_competency');
    //     print_r($this->input->post());
    // }

    // public function reject($idData)
    // {
    //     $competency = $this->input->post('competency');
    //     $this->competency_model->updateCompetency($idData, $competency, 'rzl_m_competency');
    //     print_r($this->input->post());
    // }    
    
}
