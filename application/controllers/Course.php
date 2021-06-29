<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model'));
        if (empty($this->session->userdata('email'))) {
            redirect('login');
        }
    }

    // public function index()
    // {
    //     $data['aset'] = $this->aset_model->getAlldata();
    //     $this->load->view('aset', $data);
    // }

    public function preTest($idGetCourse)
    {
        $data['preTest'] = $this->course_model->getPreTest($idGetCourse);

        $this->load->view('preTest',$data);
    }

    public function add()
    {
        $data['typeaset'] = $this->aset_model->getAlltype();
        $data['jenis'] = $this->aset_model->getAllJenis();
        $data['nama'] = $this->aset_model->getAllNama();
        $this->load->view('asetAdd', $data);
    }


    public function saveData()
    {
        $data = $this->input->post('aset');
        $this->aset_model->saveData($data, 'tblaset');
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['typeaset'] = $this->aset_model->getAlltype();
            $data['jenis'] = $this->aset_model->getAllJenis();
            $data['nama'] = $this->aset_model->getAllNama();
            $data['aset']     = $this->aset_model->getDataById($idData);
        }
        $this->load->view('asetEdit', $data);
    }

    public function updateData($idData)
    {
        $aset = $this->input->post('aset');
        $this->aset_model->updateData($idData, $aset, 'tblaset');
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            $this->aset_model->deleteData($idData, "tblaset");
        }
        return "Data Berhasil Di Delete";
    }
}
