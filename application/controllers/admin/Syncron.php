<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Syncron extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('peserta_model','course_model'));
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
        // $this->load->view('admin/master/backupQuestion');
    }

    function syncSaveJibas(){
        $data = $this->input->post();
        //print_array($data);
        $Aidsiswa = $data['IdSiswa'];
        $Anis = $data['NIS'];
        $Anisn = $data['NISN'];
        $Anama = $data['Nama'];
        $APanggilan  = $data['Panggilan'];
        $ANIK        = $data['NIK'];
        $AJenKel     = $data['JenKel'];
        $ATempatLahir= $data['TempatLahir'];
        $ATglLahir   = $data['TglLahir'];
        $AAlamat     = $data['Alamat'];
        $ANamaAyah     = $data['NamaAyah'];
        $ANamaIbu     = $data['NamaIbu'];

        $Jnis = $data['nis'];
        $Jnisn = $data['nisn'];
        $Jnama = $data['nama'];        
        $Jpanggilan = $data['panggilan'];        
        $Jnik = $data['nik'];        
        $Jkelamin = $data['kelamin'];        
        $Jtmplahir = $data['tmplahir'];        
        $Jtgllahir = $data['tgllahir'];        
        $Jalamatsiswa = $data['alamatsiswa'];        
        $Jnamaayah = $data['namaayah'];        
        $Jnamaibu = $data['namaibu'];        
        
        //echo $Anis[1];
        for ($i=0; $i < count($Anis) ; $i++) { 
            if ($Anisn[$i] != $Jnisn[$i] || $Anama[$i] != $Jnama[$i] || $APanggilan != $Jpanggilan || $ANIK !=$Jnik || $AJenKel != $Jkelamin ||
                $ATempatLahir != $Jtmplahir || $ATglLahir != $Jtgllahir || $AAlamat != $Jalamatsiswa || $ANamaAyah != $Jnamaayah || $ANamaIbu != $Jnamaibu ) {
                if ($Jnama[$i]=="") {
                    echo "Siswa " . $Anama[$i] . "Belum ada di Jibas"; echo "<br>";

                }else{
                    $arr = array(
                        'NISN' => $Jnisn[$i],
                        'Nama' => $Jnama[$i],
                        'Panggilan' => $Jpanggilan[$i],
                        'NIK' => $Jnik[$i],
                        'JenKel' => $Jkelamin[$i],
                        'TempatLahir' => $Jtmplahir[$i],
                        'TglLahir' => $Jtgllahir[$i],
                        'Alamat' => $Jalamatsiswa[$i],
                        'NamaAyah' => $Jnamaayah[$i],
                        'NamaIbu' => $Jnamaibu[$i]
                    );
                    echo $this->siswa_model->UpdateData($Aidsiswa[$i],$arr,'tblsiswa'); echo "<br>";
                }
                //print_array($arr);
                
            }
        }
        echo "<a href=" . base_url('siswa/syncJibas') .">Back</a>";
    }

    function syncJibas(){
        $data['aplikasi'] = $this->siswa_model->getSiswaJibas();
        //echo $data['jibas'][0]->nama; 
        //print_array($data);
        $this->load->view('view_syncJibas',$data);
    }

    function saveJibas(){
        $this->siswa_model->truncate('siswajibas');

        $jibas = $this->getApi();
        $data =  json_decode(json_encode($jibas),true); //convert stdClass Object to array
        for ($i=0; $i < count($data) ; $i++) { 
            $this->siswa_model->saveData($data[$i],'siswajibas');
        }  
        $data['aplikasi'] = $this->siswa_model->getSiswaJibas();
        $this->load->view('view_syncJibas',$data);
    }    

    function getApi(){
        //$url="http://10.10.10.252/api/getsiswa.php";
        $url="http://localhost/ananda/api/getsiswa.php";
        $get_url = file_get_contents($url);
        $data = json_decode($get_url);

        // $data_array = array(
        //     'datalist' => $data
        // );
        return $data;
        //print_array($data_array);
        //$this->load->view('json/json_list',$data_array);
    }


}
