<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model'));
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
        $this->course_model->saveData($data, 'rzl_m_course');
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
        $this->course_model->updateData($idData, $course, 'rzl_m_course');
        print_r($this->input->post());
    }

    public function updateCourse($idData)
    {
        $course = $this->input->post('course');
        $this->course_model->updateCourse($idData, $course, 'rzl_m_course');
        print_r($this->input->post());
    }


    function delete($idData)
    {
        if (isset($idData)) {
            $cekquestion = $this->course_model->getQuestionById($idData);
            if(count($cekquestion)<1){
                $this->course_model->deleteCourse($idData, "rzl_m_course");
                echo "true";
            }else{
                echo "false";
            }

        }
    }

    public function resetPassword($idData)
    {
        $course = $this->input->post('course');
        $this->course_model->updateData($idData, $course, 'rzl_m_course');
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
                $this->course_model->saveData($data, 'rzl_m_question');

            }
        }
        $data['question'] = $this->course_model->getQuestionById($idCourse);
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('admin/master/question', $data);
    }

    public function updateQuestion($idData)
    {
        $data = $this->input->post('question');
        $this->course_model->updateQuestion($idData, $data, 'rzl_m_question');
        print_r($this->input->post());
    }


}
