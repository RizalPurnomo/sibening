<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reporting extends CI_Controller
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
            redirect('login');
        }          
    }

    public function index()
    {
        $idpeserta = $this->session->userdata('nip');
        $getcourse = $this->course_model->getCourse($idpeserta);
        $data['getcourse'] = $getcourse;
        $data['course'] = $this->course_model->availableCourse($idpeserta);
        $data['jpl'] = $this->course_model->getJpl($idpeserta);
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

        $this->load->view('reporting',$data);
    }
}