<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model'));
        if (empty($this->session->userdata('email'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $idpeserta = $this->session->userdata('idpeserta');
        $data['getcourse'] = $this->course_model->getCourse($idpeserta);
        $data['course'] = $this->course_model->allCourse();
        $this->load->view('dashboard',$data);
        // print_r($data);

    }
}
