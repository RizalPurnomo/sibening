<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Import extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('course_model'));
        // if (empty($this->session->userdata('username'))) {
        //     redirect('login');
        // }
    }     

    public function index() {
        $data['course'] = $this->course_model->allCourse();
        // print_r($data);
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

	public function export() {
        $id = $this->input->post();

        $data['course'] = $this->course_model->getCourseById($id['idcourse']);

        // echo "<pre/>";
        // print_r($data);


        $spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();
        // manually set table data value
        $sheet->setCellValue('A1', $data['course'][0]['idcourse']); 
        $sheet->setCellValue('B1', $data['course'][0]['title']);
        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Question');
        $sheet->setCellValue('C3', 'Pil A');
        $sheet->setCellValue('D3', 'Pil B');
        $sheet->setCellValue('E3', 'Pil C');
        $sheet->setCellValue('F3', 'Pil D');
        $sheet->setCellValue('G3', 'Pil E');
        $sheet->setCellValue('H3', 'Key');
        $barisAwal = 4;
        for ($i=0; $i < 10 ; $i++) { 
            //Tambah Nomor
            $sheet->setCellValue('A'.$barisAwal, $i+1);
            
            //Seting Height
            $sheet->getRowDimension($barisAwal)->setRowHeight(35,'pt');

            $barisAwal++;
        }

        //Memberi Warna hijau di kolom available edit
        $sheet->getStyle('B4:H13')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('E6FFBA');      
        $sheet->getStyle('A16:C16')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF4739');              

        //Memberi Border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        $sheet->getStyle('A3:H13')->applyFromArray($styleArray);   
        
        //Seting Width
        $sheet->getColumnDimension('A')->setWidth(4, 'pt');
        $sheet->getColumnDimension('B')->setWidth(42, 'pt');
        $sheet->getColumnDimension('C')->setWidth(27, 'pt');
        $sheet->getColumnDimension('D')->setWidth(27, 'pt');
        $sheet->getColumnDimension('E')->setWidth(27, 'pt');
        $sheet->getColumnDimension('F')->setWidth(27, 'pt');
        $sheet->getColumnDimension('G')->setWidth(27, 'pt');
        $sheet->getColumnDimension('h')->setWidth(7, 'pt');

        //Set Wrap
        $sheet->getStyle('B4:H13')->getAlignment()->setWrapText(true);


        $sheet->setCellValue('A16', 'Note : Jangan merubah format dan hanya diisi di kolom berwarna!!');
        
        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
        $filename = 'Import Question - ' . $data['course'][0]['title']; // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
    }
    
} 