<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('peserta_model','course_model'));
        if (empty($this->session->userdata('realname'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $this->load->view('admin/master/backupQuestion');
    }

    public function progresPeserta(){
        $data['peserta'] = $this->peserta_model->getAllPeserta();
        $data['progress'] = $this->course_model->progressPeserta();
        $data['getJplFinish'] = $this->course_model->getJplFinish();
        $this->load->view('admin/report/progresPeserta',$data);
    }

    public function logCourse(){
        $data['peserta'] = $this->peserta_model->getPesertaTerdaftar();
        // $data['progress'] = $this->course_model->progressPeserta();
        $this->load->view('admin/report/logCourse',$data);
    }

    public function progresDetail($idpeserta){
        $data['getcourse'] = $this->course_model->getCourse($idpeserta);
        $data['course'] = $this->course_model->availableCourse($idpeserta);
        $data['peserta'] = $this->peserta_model->getPesertaById($idpeserta);
        $this->load->view('admin/report/progresDetail',$data);
    }    

    public function preTest($idGetCourse)
    {
        $data['preTest'] = $this->course_model->getPreTest($idGetCourse);
        $data['peserta'] = $this->peserta_model->getPesertaById($data['preTest'][0]['idpeserta']);
        $data['idgetcourse'] = $idGetCourse;
        $this->load->view('admin/report/preTest',$data);
    }    

    // public function importQuestion()
    // {
    //     $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
    //         $arr_file = explode('.', $_FILES['upload_file']['name']);
    //         $extension = end($arr_file);
    //         if ('csv' == $extension) {
    //             $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    //         } else {
    //             $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //         }
    //         $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
    //         $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //         $data['sheetData'] = $sheetData;
    //         // echo "<pre>";
    //         // print_r($data);
    //         $this->load->view('admin/master/backupPreviewQuestion', $data);
    //     }
    // }    




    //------------------------
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
            $cekquestion = $this->course_model->getQuestionById($idData);
            if(count($cekquestion)<1){
                $this->course_model->deleteCourse($idData, "mcourse");
                echo "true";
            }else{
                echo "false";
            }

        }
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
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('admin/master/question', $data);
    }

    public function updateQuestion($idData)
    {
        $data = $this->input->post('question');
        $this->course_model->updateQuestion($idData, $data, 'mquestion');
        print_r($this->input->post());
    }


}
