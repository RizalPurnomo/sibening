<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('peserta_model'));
        // if (empty($this->session->userdata('nip'))) {
        //     redirect('login');
        // }
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            $this->session->set_flashdata('message_type', 'error');
            $this->session->set_flashdata('messages', 'Please login first.');
            redirect('admin/login');
        }        

    }

    public function index()
    {
        $data['peserta'] = $this->peserta_model->getAllPesertaAktif();
        $this->load->view('admin/master/peserta',$data);
    }

    public function add()
    {
        $this->load->view('admin/master/pesertaAdd');
    }


    public function saveData()
    {
        $data = $this->input->post('peserta');
        $this->peserta_model->saveData($data, 'mpeserta');
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['peserta'] = $this->peserta_model->getPesertaById($idData);
        }
        $this->load->view('admin/master/pesertaEdit', $data);
    }

    public function updateData($idData)
    {
        $peserta = $this->input->post('peserta');
        $this->peserta_model->updateData($idData, $peserta, 'mpeserta');
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->peserta_model->deleteData($idData, "mpeserta");
        }
        return "Data Berhasil Di Delete";
    }

    public function resetPassword($idData)
    {
        $peserta = $this->input->post('peserta');
        $this->peserta_model->updateData($idData, $peserta, 'mpeserta');
        print_r($this->input->post());
    }
}
