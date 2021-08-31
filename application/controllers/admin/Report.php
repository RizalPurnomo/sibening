<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('peserta_model','course_model','competency_model'));
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
        $this->load->view('admin/master/backupQuestion');
    }

    public function progresPeserta(){
        $data['peserta'] = $this->peserta_model->getAllPesertaAktif();
        $data['progress'] = $this->course_model->progressPeserta();
        $progress = $data['progress'];
        $data['getJplFinish'] = $this->course_model->getSumJplFinish();
        $data['getJplApproved'] = $this->competency_model->getSumJplApproved();
        $data['totalJpl'] = $data['getJplFinish'][0]['jplFinish'] + $data['getJplApproved'][0]['jplApproved'];
        
        $totalJplPeserta=0;
        for ($i=0; $i < count($progress) ; $i++) { 
            if($progress[$i]['totaljpl']>20){
                $a = 20;
            }else{
                $a = $progress[$i]['totaljpl'];
            }
            $totalJplPeserta = $totalJplPeserta + $a;
        }
        $data['totalJplPeserta'] = $totalJplPeserta;


        // $data['competency'] = $this->course_model->getCompetencyByNip($idpeserta);
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('admin/report/progresPeserta',$data);
    }

    public function logCourse(){
        $data['peserta'] = $this->peserta_model->getPesertaTerdaftar();
        // $data['progress'] = $this->course_model->progressPeserta();
        $this->load->view('admin/report/logCourse',$data);
    }

    public function progresDetail($idpeserta){
        $thnIni = date("Y");
        $getcourse = $this->course_model->getCourse($idpeserta,$thnIni);
        $competency = $this->competency_model->getCompetencyByNip($idpeserta,$thnIni);
        $data['getcourse'] = $getcourse;
        $data['competency'] = $competency;
        $data['course'] = $this->course_model->availableCourse($idpeserta);
        $data['peserta'] = $this->peserta_model->getPesertaById($idpeserta);

        $data['enrolledCourse'] = count($getcourse);
        $data['finishCourse'] = 0;
        $data['getJPL'] = 0;
        $data['targetJPL'] = 20;
        $data['finishJPL'] = 0;
        for ($i=0; $i < count($getcourse) ; $i++) { 
            if ($getcourse[$i]['flag'] == 'finish') {
                $data['finishCourse']++;
                $data['finishJPL'] = $data['finishJPL'] + $getcourse[$i]['jpl'];
            }
            
            $data['getJPL'] = $data['getJPL'] + $getcourse[$i]['jpl']; 
        }

        for ($i=0; $i < count($competency) ; $i++) { 
            if ($competency[$i]['statuscompetency'] == 'approved') {
                $data['finishJPL'] = $data['finishJPL'] + $competency[$i]['jplapproved'];
            }
            
        }        

        if($data['enrolledCourse']<1){
            $data['percentageFinishEnroll'] =0;  
        }else{
            $data['percentageFinishEnroll'] = ($data['finishCourse']/$data['enrolledCourse'])*100;
        }
        $data['percentageJplTarget'] = ($data['getJPL']/$data['targetJPL'])*100;
        $data['percentage'] = ($data['finishJPL']/$data['targetJPL'])*100;

        // echo "<pre/>";
        // print_r($data);
        $this->load->view('admin/report/progresDetail',$data);
    }    

    public function preTest($idGetCourse)
    {
        $preTest = $this->course_model->getPreTest($idGetCourse);
        if(count($preTest)!=10){
            echo "Data Soal Belum Siap";
        }else{
            $data['preTest'] = $preTest;
            $data['peserta'] = $this->peserta_model->getPesertaById($data['preTest'][0]['nip']);
            $data['idgetcourse'] = $idGetCourse;
            $this->load->view('admin/report/preTest',$data);
        }
    }    

    public function postTest($idGetCourse)
    {
        $postTest = $this->course_model->getPostTest($idGetCourse);
        if(count($postTest)!=10){
            echo "Data Soal Belum Siap";
        }else{
            $data['postTest'] = $postTest;
            $data['peserta'] = $this->peserta_model->getPesertaById($data['postTest'][0]['nip']);
            $data['idgetcourse'] = $idGetCourse;          
            $this->load->view('admin/report/postTest',$data);
        }
    } 







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
