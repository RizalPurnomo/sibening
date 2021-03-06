<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model', 'praktek_model', 'competency_model'));
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
        $thnIni = date("Y");
        $idpeserta = $this->session->userdata('nip');
        $data['course'] = $this->course_model->availableCourse($idpeserta);

        $competency = $this->competency_model->getCompetencyByNip($idpeserta, $thnIni);
        $getcourse = $this->course_model->getCourse($idpeserta, $thnIni);
        $data['getcourse'] = $getcourse;
        $data['competency'] = $competency;
        $data['enrolledCourse'] = count($getcourse);
        $data['finishCourse'] = 0;
        $data['getJPL'] = 0;
        $data['targetJPL'] = 20;
        $data['finishJPL'] = 0;
        for ($i = 0; $i < count($getcourse); $i++) {
            if ($getcourse[$i]['flag'] == 'finish') {
                $data['finishCourse']++;
                $data['finishJPL'] = $data['finishJPL'] + $getcourse[$i]['jpl'];
            }

            $data['getJPL'] = $data['getJPL'] + $getcourse[$i]['jpl'];
        }

        for ($i = 0; $i < count($competency); $i++) {
            if ($competency[$i]['statuscompetency'] == 'approved') {
                $data['finishJPL'] = $data['finishJPL'] + $competency[$i]['jplapproved'];
            }
        }

        if ($data['enrolledCourse'] < 1) {
            $data['percentageFinishEnroll'] = 0;
        } else {
            $data['percentageFinishEnroll'] = ($data['finishCourse'] / $data['enrolledCourse']) * 100;
        }
        $data['percentageJplTarget'] = ($data['getJPL'] / $data['targetJPL']) * 100;
        $data['percentage'] = ($data['finishJPL'] / $data['targetJPL']) * 100;
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('course', $data);
    }


    public function preTest($idGetCourse)
    {
        $preTest = $this->course_model->getPreTest($idGetCourse);
        if (count($preTest) != 10) {
            echo "Data Soal Belum Siap";
        } else {
            $data['preTest'] = $preTest;
            $data['idgetcourse'] = $idGetCourse;
            $this->load->view('preTest', $data);
        }
    }

    public function postTest($idGetCourse)
    {
        $postTest = $this->course_model->getPostTest($idGetCourse);
        if (count($postTest) != 10) {
            echo "Data Soal Belum Siap";
        } else {
            $data['postTest'] = $postTest;
            $data['idgetcourse'] = $idGetCourse;
            $this->load->view('postTest', $data);
        }
    }



    public function materi($idGetCourse)
    {
        $data['course'] = $this->course_model->getCourseDetailById($idGetCourse);
        $this->load->view('materi', $data);
    }

    public function finishMateri($idGetCourse)
    {
        $dataTest = array(
            'flag' => 'post'
        ); //update flag
        $this->course_model->updateFlag($idGetCourse, $dataTest, 'rzl_getcourse');
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
            $this->course_model->deleteData($idGetCourse, "rzl_getcourse");
        }
        return "Data Berhasil Di Delete";
    }

    public function saveUpdateData($idGetCourse)
    {
        // echo $idGetCourse;
        $question = $this->input->post('question');
        $answer = $this->input->post('answer');
        for ($i = 0; $i < count($question); $i++) {
            $noSoal = $i + 1;
            $sdhJawab = $this->course_model->getSudahDijawab($idGetCourse, $question['soal' . $noSoal]);
            $jawabanBenar = $this->course_model->getJawabanBenar($question['soal' . $noSoal]);
            if ($jawabanBenar[0]['key'] == $answer['no' . $noSoal]) {
                $benar = "y";
            } else {
                $benar = "n";
            }
            $data = array(
                "idgetcourse" => $idGetCourse,
                "idquestion" => $question['soal' . $noSoal],
                "answer" => $answer['no' . $noSoal],
                "key" => $jawabanBenar[0]['key'],
                "benar" => $benar
            );

            if ($sdhJawab == '') { //save answer
                $this->course_model->saveData($data, 'rzl_answer');
            } else { //update answer
                $this->course_model->updateData($sdhJawab, $data, 'rzl_answer');
            }

            $dataTest = array(
                'flag' => 'materi'
            ); //update flag
            $this->course_model->updateFlag($idGetCourse, $dataTest, 'rzl_getcourse');
        }
    }

    public function saveUpdateDataPost($idGetCourse)
    {
        // echo $idGetCourse;
        $course = $this->course_model->getCourseDetailById($idGetCourse);

        $question = $this->input->post('question');
        $answerpost = $this->input->post('answer');
        for ($i = 0; $i < count($question); $i++) {
            $noSoal = $i + 1;
            $sdhJawabPost = $this->course_model->getSudahDijawabPost($idGetCourse, $question['soal' . $noSoal]);
            $jawabanBenar = $this->course_model->getJawabanBenar($question['soal' . $noSoal]);
            if ($jawabanBenar[0]['key'] == $answerpost['no' . $noSoal]) {
                $benar = "y";
            } else {
                $benar = "n";
            }
            $data = array(
                "idgetcourse" => $idGetCourse,
                "idquestion" => $question['soal' . $noSoal],
                "answerpost" => $answerpost['no' . $noSoal],
                "key" => $jawabanBenar[0]['key'],
                "benarpost" => $benar
            );

            if ($sdhJawabPost == '') { //save answer
                $this->course_model->saveData($data, 'rzl_answerpost');
            } else { //update answer
                $this->course_model->updateDataPost($sdhJawabPost, $data, 'rzl_answerpost');
            }

            //update flag
            if ($course[0]['tglavailablepraktek'] == "") {
                $dataTest = array(
                    'flag' => 'finish'
                );
            } else {
                $dataTest = array(
                    'flag' => 'praktek'
                );
            }

            $this->course_model->updateFlag($idGetCourse, $dataTest, 'rzl_getcourse');
        }
    }

    public function enrollCourse($idCourse)
    {
        $data = array(
            "datecourse" => date("Y/m/d h:i:s"),
            "nip" => $this->session->userdata('nip'),
            "idcourse" => $idCourse,
            "flag" => "pre"
        );
        $this->course_model->saveData($data, 'rzl_getcourse');
    }

    public function praktek($idGetCourse)
    {
        $courseDetail = $this->course_model->getCourseDetailById($idGetCourse);
        $idCourse = $courseDetail[0]['idcourse'];
        $praktek = $this->course_model->getCourseDetailById($idGetCourse)[0]['tglavailablepraktek'];
        $data['praktek'] = explode(',', $praktek);
        $data['jadwalPraktek'] = $this->praktek_model->getPraktek($this->session->userdata('nip'), $idCourse);
        $data['maxPeserta'] = $this->course_model->getCourseDetailById($idGetCourse)[0]['maxpeserta'];
        $data['idCourse'] = $idCourse;
        // echo $idGetCourse;
        // echo "<pre/>";
        // print_r($courseDetail);
        $this->load->view('praktek', $data);
    }




    // ----------------------------------

    public function add()
    {
        $data['typeaset'] = $this->aset_model->getAlltype();
        $data['jenis'] = $this->aset_model->getAllJenis();
        $data['nama'] = $this->aset_model->getAllNama();
        $this->load->view('asetAdd', $data);
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
