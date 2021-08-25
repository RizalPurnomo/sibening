<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ValidasiCompetency extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('competency_model','diklat_model','peserta_model'));

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            $this->session->set_flashdata('message_type', 'error');
            $this->session->set_flashdata('messages', 'Please login first.');
            redirect('admin/login');
        }        
    }

    public function index()
    {
        $data['competency'] = $this->competency_model->getAllCompetency();
        // print_r($data);
        $this->load->view('admin/validasi_competency',$data);
    }

    public function add()
    {
        $data['peserta'] = $this->peserta_model->getAllPeserta();
        $data['diklat'] = $this->diklat_model->getDiklatAll();
        $data['jenis'] = $this->diklat_model->getJenisDiklatAll();
        $this->load->view('admin/master/competencyAdd',$data);
    }

    public function saveData()
    {
        $data = $this->input->post('competency');
        $this->diklat_model->saveData($data, 'rzl_m_competency');
        print_r($this->input->post());
    }    

    public function approved($idData)
    {
        $competency = $this->input->post('competency');
        $this->competency_model->updateCompetency($idData, $competency, 'rzl_m_competency');
        print_r($this->input->post());
    }

    public function reject($idData)
    {
        $competency = $this->input->post('competency');
        $this->competency_model->updateCompetency($idData, $competency, 'rzl_m_competency');
        print_r($this->input->post());
    }    
    
}
