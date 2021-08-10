<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Competency extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model','competency_model'));
        // if (empty($this->session->userdata('nip'))) {
        //     redirect('login');
        // }
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            $this->session->set_flashdata('message_type', 'error');
            $this->session->set_flashdata('messages', 'Please login first.');
            redirect('login');
        }          
    }

    public function index()
    {
        $idpeserta = $this->session->userdata('nip');
        $getcourse = $this->course_model->getCourse($idpeserta);
        $data['getcourse'] = $getcourse;
        $data['competency'] = $this->course_model->getCompetencyByNip($idpeserta);
        // echo "<pre/>";
        // print_r($data);
        // exit;
        
        
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

        if($data['enrolledCourse']<1){
            $data['percentageFinishEnroll'] =0;  
        }else{
            $data['percentageFinishEnroll'] = ($data['finishCourse']/$data['enrolledCourse'])*100;
        }
        $data['percentageJplTarget'] = ($data['getJPL']/$data['targetJPL'])*100;
        $data['percentage'] = ($data['finishJPL']/$data['targetJPL'])*100;

        $this->load->view('competency',$data);
    }

    public function add()
    {
        $idpeserta = $this->session->userdata('nip');
        $getcourse = $this->course_model->getCourse($idpeserta);
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

        if($data['enrolledCourse']<1){
            $data['percentageFinishEnroll'] =0;  
        }else{
            $data['percentageFinishEnroll'] = ($data['finishCourse']/$data['enrolledCourse'])*100;
        }
        $data['percentageJplTarget'] = ($data['getJPL']/$data['targetJPL'])*100;
        $data['percentage'] = ($data['finishJPL']/$data['targetJPL'])*100;        
        $this->load->view('competencyAdd',$data);
    }   
    
    public function upload(){
        /* Get the name of the uploaded file */
        $nama = $this->session->userdata('nama_lengkap');
        $filename = $nama . " - " . $_FILES['file']['name'];

        /* Choose where to save the uploaded file */
        $location = 'uploads/competency/'.$filename;

        /* Save the uploaded file to the local filesystem */
        if ( move_uploaded_file($_FILES['file']['tmp_name'], $location) ) { 
            echo 'Success'; 
        } else { 
            echo 'Failure'; 
        }  
    }  
    
    public function saveData()
    {
        $data = $this->input->post('competency');
        $this->course_model->saveData($data, 'rzl_m_competency');
        print_r($this->input->post());
    }

    function delete($idData)
    {
        if (isset($idData)) {
            //delete file
            $cekCompetency = $this->competency_model->getCompetencyById($idData);
            $link = './uploads/competency/' . $cekCompetency[0]['files']; 
            unlink($link); 
            //delete db
            $this->competency_model->deleteCompetency($idData, "rzl_m_competency");

        }
    }   
    
    function edit($idData)
    {
        if (isset($idData)) {
            $data['competency'] = $this->competency_model->getCompetencyById($idData);

            $idpeserta = $this->session->userdata('nip');
            $getcourse = $this->course_model->getCourse($idpeserta);
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
    
            if($data['enrolledCourse']<1){
                $data['percentageFinishEnroll'] =0;  
            }else{
                $data['percentageFinishEnroll'] = ($data['finishCourse']/$data['enrolledCourse'])*100;
            }
            $data['percentageJplTarget'] = ($data['getJPL']/$data['targetJPL'])*100;
            $data['percentage'] = ($data['finishJPL']/$data['targetJPL'])*100;             
        }
        // print_r($data);
        $this->load->view('competencyEdit', $data);
    }   
    
    public function updateData($idData)
    {
        $competency = $this->input->post('competency');
        $this->competency_model->updateCompetency($idData, $competency, 'rzl_m_competency');
        print_r($this->input->post());
    }    

}