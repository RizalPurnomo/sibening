<?php
defined('BASEPATH') or exit('No direct script access allowed');

// require 'assets/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;


class Import extends CI_Controller
{
    

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model'));
        if (empty($this->session->userdata('username'))) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['course'] = $this->course_model->allCourse();
        $this->load->view('admin/master/importQuestion',$data);

    }

    public function importQuestion()
    {
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        if (isset($_FILES['upload_file']['name']) && in_array($_FILES['upload_file']['type'], $file_mimes)) {
            $arr_file = explode('.', $_FILES['upload_file']['name']);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $data['sheetData'] = $sheetData;
            // echo "<pre>";
            // print_r($data);
            $this->load->view('admin/master/importPreviewQuestion', $data);
        }
    }    

    public function saveQuestion()
    {
        // echo $this->input->post('idCourse');
        $q = $this->course_model->getQuestionById($this->input->post('idCourse'));
        print_r($q);
        // exit;
        if(empty($q)){ //tambahkan question kosong
            $this->savedQuestion();
        }else{
            $this->course_model->deleteCourse($this->input->post('idCourse'), 'mquestion');
            $this->savedQuestion();
        }


    }

    function savedQuestion()
    {
        $jum = count($this->input->post('question'));
        //insert Batch
        for ($i = 0; $i < $jum; $i++) {
            $dataQuestion = array(
                'idCourse' => $this->input->post('idCourse'),
                'question' => $this->input->post('question')[$i],
                'pila'  => $this->input->post('pila')[$i],
                'pilb'  => $this->input->post('pilb')[$i],
                'pilc'  => $this->input->post('pilc')[$i],
                'pild'  => $this->input->post('pild')[$i],
                'pile'  => $this->input->post('pile')[$i],
                'key'   => $this->input->post('key')[$i],
            );
            $this->course_model->saveData($dataQuestion, 'mquestion');
        }
        echo "Berhasil Disimpan";
    }

    public function export()
    {
        
        // require 'assets/vendor/autoload.php';

        // use PhpOffice\PhpSpreadsheet\Spreadsheet;
        // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
        
        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');
        
        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xls');


        $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        // manually set table data value
        $sheet->setCellValue('A1', 'Gipsy Danger'); 
        $sheet->setCellValue('A2', 'Gipsy Avenger');
        $sheet->setCellValue('A3', 'Striker Eureka');
        
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = 'list-of-jaegers'; // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file      
    }    





    // public function question()
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
    //         $this->load->view('admin/master/backupQuestion', $data);
    //     }
    // }

    // public function export()
    // {
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->setCellValue('A1', 'Hello World !');
    //     $writer = new Xlsx($spreadsheet);
    //     $filename = 'name-of-the-generated-file';
    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     $writer->save('php://output'); // download file
    // }



    // public function add()
    // {
    //     $data['idbarang']   = $this->barang_model->getIdData(date('y'));
    //     $data['satuan'] = $this->satuan_model->getAlldata();
    //     $this->load->view('master/vBarangAdd', $data);
    // }

    // public function saveData()
    // {
    //     $data = $this->input->post('barang');
    //     $this->barang_model->saveData($data, 'tblmbarang');
    //     print_r($this->input->post());
    // }

    // function edit($idData)
    // {
    //     if (isset($idData)) {
    //         $data['barang']     = $this->barang_model->getDataById($idData);
    //         $data['satuan'] = $this->satuan_model->getAlldata();
    //     }
    //     $this->load->view('master/vBarangEdit', $data);
    // }

    // public function updateData($idData)
    // {
    //     $barang = $this->input->post('barang');
    //     $this->barang_model->updateData($idData, $barang, 'tblmbarang');
    //     print_r($this->input->post());
    // }

    // function delete($idData)
    // {
    //     if (isset($idData)) {
    //         $this->barang_model->deleteData($idData, "tblmbarang");
    //     }
    //     return "Data Berhasil Di Delete";
    // }

    // -----
    // function getBarangByLokasi($idLokasi)
    // {
    //     $barang = $this->barang_model->getBarangByLokasi($idLokasi);
    //     echo json_encode($barang);
    // }
}
