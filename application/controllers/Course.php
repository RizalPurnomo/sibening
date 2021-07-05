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

    public function index()
    {
        $idpeserta = $this->session->userdata('idpeserta');
        $data['getcourse'] = $this->course_model->getCourse($idpeserta);
        $data['course'] = $this->course_model->allCourse();
        $data['hasil'] = $this->course_model->getCourseHasilById('6');
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('course',$data);
    }

    public function preTest($idGetCourse)
    {
        $data['preTest'] = $this->course_model->getPreTest($idGetCourse);
        $data['idgetcourse'] = $idGetCourse;
        $this->load->view('preTest',$data);
    }

    public function postTest($idGetCourse)
    {
        $data['postTest'] = $this->course_model->getPostTest($idGetCourse);
        $data['idgetcourse'] = $idGetCourse;
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('postTest',$data);
    }    

    public function materi($idGetCourse)
    {
        $data['course'] = $this->course_model->getCourseDetailById($idGetCourse);
        $this->load->view('materi',$data);
    }    

    public function finishMateri($idGetCourse){
        $dataTest = array(
            'flag' => 'post'
        ); //update flag
        $this->course_model->updateFlag($idGetCourse, $dataTest, 'getcourse');
    }

    public function hasil($idGetCourse)
    {
        $arr = $this->course_model->getCoursehasilById($idGetCourse);
        // $this->load->view('hasil',$data);
        echo json_encode($arr);
    }  

    function deleteCourse($idGetCourse)
    {
        if (isset($idGetCourse)) {
            $this->course_model->deleteData($idGetCourse, "getcourse");
        }
        return "Data Berhasil Di Delete";
    }

    public function saveUpdateData($idGetCourse){
        // echo $idGetCourse;
        $question = $this->input->post('question');
        $answer = $this->input->post('answer');
        for ($i=0; $i < count($question) ; $i++) { 
            $noSoal = $i+1;
            $sdhJawab = $this->course_model->getSudahDijawab($idGetCourse,$question['soal'.$noSoal]);
            $jawabanBenar = $this->course_model->getJawabanBenar($question['soal'.$noSoal]);
            if($jawabanBenar[0]['key'] == $answer['no'.$noSoal] ){
                $benar = "y";
            }else{
                $benar = "n";
            }
            $data = array(
                "idgetcourse" => $idGetCourse,
                "idquestion" => $question['soal'.$noSoal],
                "answer" => $answer['no'.$noSoal],
                "key" => $jawabanBenar[0]['key'],
                "benar" => $benar
            );    

            if($sdhJawab==''){//save answer
                $this->course_model->saveData($data, 'answer');
            }else{//update answer
                $this->course_model->updateData($sdhJawab, $data, 'answer');
            }

            $dataTest = array(
                'flag' => 'materi'
            ); //update flag
            $this->course_model->updateFlag($idGetCourse, $dataTest, 'getcourse');

        }
    }

    public function saveUpdateDataPost($idGetCourse){
        // echo $idGetCourse;
        $question = $this->input->post('question');
        $answerpost = $this->input->post('answer');
        for ($i=0; $i < count($question) ; $i++) { 
            $noSoal = $i+1;
            $sdhJawabPost = $this->course_model->getSudahDijawabPost($idGetCourse,$question['soal'.$noSoal]);
            $jawabanBenar = $this->course_model->getJawabanBenar($question['soal'.$noSoal]);    
            if($jawabanBenar[0]['key'] == $answerpost['no'.$noSoal] ){
                $benar = "y";
            }else{
                $benar = "n";
            }
            $data = array(
                "idgetcourse" => $idGetCourse,
                "idquestion" => $question['soal'.$noSoal],
                "answerpost" => $answerpost['no'.$noSoal],
                "key" => $jawabanBenar[0]['key'],
                "benarpost" => $benar
            );    

            if($sdhJawabPost==''){//save answer
                $this->course_model->saveData($data, 'answerpost');
            }else{//update answer
                $this->course_model->updateDataPost($sdhJawabPost, $data, 'answerpost');
            }

            $dataTest = array(
                'flag' => 'finish'
            ); //update flag
            $this->course_model->updateFlag($idGetCourse, $dataTest, 'getcourse');

        }
    }    

    public function enrollCourse($idCourse){
        $data = array(
            "datecourse" => date("Y/m/d h:i:s"),
            "idpeserta" => $this->session->userdata('idpeserta'),
            "idcourse" => $idCourse,
            "flag" => "pre"
        ); 
        $this->course_model->saveData($data, 'getcourse');
    }




    // ----------------------------------

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
