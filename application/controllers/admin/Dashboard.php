<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model(array('course_model'));
        // if (empty($this->session->userdata('nip'))) {
        //     redirect('admin/login');
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
        // $idpeserta = $this->session->userdata('idpeserta');
        // $data['getcourse'] = $this->course_model->getCourse($idpeserta);
        // $data['course'] = $this->course_model->allCourse($idpeserta);
        $this->load->view('admin/dashboard');
        // print_r($data);

    }
}
