<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model'));
        if (empty($this->session->userdata('realname'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['course'] = $this->course_model->allCourse();
        $this->load->view('admin/master/course',$data);
    }

    public function add()
    {
        $data['kategori'] = $this->course_model->getAllKategori();
        $this->load->view('admin/master/courseAdd',$data);
    }


    public function saveData()
    {
        $data = $this->input->post('course');
        $this->course_model->saveData($data, 'mcourse');
        print_r($this->input->post());
    }

    function edit($idData)
    {
        if (isset($idData)) {
            $data['kategori'] = $this->course_model->getAllKategori();
            $data['course'] = $this->course_model->getCourseById($idData);
        }
        $this->load->view('admin/master/courseEdit', $data);
    }

    public function updateData($idData)
    {
        $course = $this->input->post('course');
        $this->course_model->updateData($idData, $course, 'mcourse');
        print_r($this->input->post());
    }

    public function updateCourse($idData)
    {
        $course = $this->input->post('course');
        $this->course_model->updateCourse($idData, $course, 'mcourse');
        print_r($this->input->post());
    }


    function delete($idData)
    {
        if (isset($idData)) {
            $this->course_model->deleteCourse($idData, "mcourse");
        }
        return "Data Berhasil Di Delete";
    }

    public function resetPassword($idData)
    {
        $course = $this->input->post('course');
        $this->course_model->updateData($idData, $course, 'mcourse');
        print_r($this->input->post());
    }

    function question($idCourse)
    {
        $q = $this->course_model->getQuestionById($idCourse);
        if(count($q)<1){ //tambahkan question kosong
            for ($a = 0; $a < 10; $a++) {
                $data = array(
                    'idcourse' => $idCourse,
                    'question' => '',
                    'pila' => '',
                    'pilb' => '',
                    'pilc' => '',
                    'pild' => '',
                    'pile' => '',
                    'key' => ''
                );
                $this->course_model->saveData($data, 'mquestion');

            }
        }
        $data['question'] = $this->course_model->getQuestionById($idCourse);
        $this->load->view('admin/master/question', $data);
    }

    public function updateQuestion($idData)
    {
        $data = $this->input->post('question');
        $this->course_model->updateQuestion($idData, $data, 'mquestion');
        print_r($this->input->post());
    }


}
