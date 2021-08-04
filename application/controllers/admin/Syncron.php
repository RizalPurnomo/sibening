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

    //-----------------------------


    function getApi(){
        
        $conn = $this->urlExists('10.50.171.111');
        if ($conn == true) {
            $this->syncronPeserta();
        }else{
            return false;
            // echo "Tidak Terkoneksi dengan Server PHC Matraman, Harap Koneksikan dahulu dengan server";
        }
    }

    function syncronPeserta(){
        $url="http://localhost/sibening/api/getUser.php";
        $get_url = file_get_contents($url);
        $data['server'] = json_decode($get_url,true);
        $data['lokal'] = $this->peserta_model->getAllUser();
        // echo "<pre/>";
        // print_r($data);
        $this->load->view('admin/syncron',$data);
    }

    public function saveSyncronUser()
    {
        $jum = count($this->input->post('id'));
        //insert Batch
        for ($i = 0; $i < $jum; $i++) {
            $dataUser = array(
                'email'  => $this->input->post('email')[$i],
                'pass'  => $this->input->post('pass')[$i],
                'username'  => $this->input->post('username')[$i],
                'banned'  => $this->input->post('banned')[$i],
                'nama_lengkap'  => $this->input->post('nama_lengkap')[$i],
                'nip'   => $this->input->post('nip')[$i],
            );
            $this->peserta_model->updateUser($this->input->post('id')[$i],$dataUser, 'aauth_users');
        }

        $url="http://localhost/sibening/api/getUser.php";
        $get_url = file_get_contents($url);
        $data['server'] = json_decode($get_url,true);
        echo "Berhasil Disimpan";

        // if(empty($q)){ //tambahkan question kosong
        //     $this->savedQuestion();
        // }else{
        //     $this->course_model->deleteCourse($this->input->post('idCourse'), 'rzl_m_question');
        //     $this->savedQuestion();
        // }
        // $data['question'] = $this->course_model->getQuestionById($this->input->post('idCourse'));
        // $this->load->view('admin/master/question' , $data);


    }    

    function urlExists($url=NULL)  
    {  
        if($url == NULL) return false;  
        $ch = curl_init($url);  
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        $data = curl_exec($ch);  
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);  
        curl_close($ch);  
        if($httpcode>=200 && $httpcode<300){  
            return true;  
        } else {  
            return false;  
        }  
    }  


}
