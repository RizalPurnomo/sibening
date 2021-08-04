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
        $this->load->view('admin/syncron');
    }

    function getApi(){
        
        $conn = $this->urlExists('10.50.171.111');
        if ($conn == true) {
            $this->saveSyncron();
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
        echo "Berhasil Disimpan";

    }    

    public function saveSyncron(){
        $urlUser="http://localhost/sibening/api/getUser.php";
        $get_url_user = file_get_contents($urlUser);
        $serverUser = json_decode($get_url_user,true);
        $lokalUser = $this->peserta_model->getAllUser();        

        for ($i=0; $i < count($serverUser); $i++) { 

            if($i < count($lokalUser)){ //Update
                $dataUser = array(
                    'id'  => $serverUser[$i]['id'],
                    'email'  => $serverUser[$i]['email'],
                    'pass'  => $serverUser[$i]['pass'],
                    'username'  => $serverUser[$i]['username'],
                    'banned'  => $serverUser[$i]['banned'],
                    'nama_lengkap'  => $serverUser[$i]['nama_lengkap'],
                    'nip'   => $serverUser[$i]['nip'],
                );
                $this->peserta_model->updateUser($serverUser[$i]['id'],$dataUser, 'aauth_users');
                echo $i . " - " . $serverUser[$i]['nama_lengkap'] . " - Berhasil Diupdate<br/>";
            }else{//Insert
                $dataUser = array(
                    'id'  => $serverUser[$i]['id'],
                    'email'  => $serverUser[$i]['email'],
                    'pass'  => $serverUser[$i]['pass'],
                    'username'  => $serverUser[$i]['username'],
                    'banned'  => $serverUser[$i]['banned'],
                    'nama_lengkap'  => $serverUser[$i]['nama_lengkap'],
                    'nip'   => $serverUser[$i]['nip'],
                );
                $this->peserta_model->saveData($dataUser, 'aauth_users');
                echo $i . " - " . $serverUser[$i]['nama_lengkap'] . " - Berhasil Ditambah<br/>";
            }
        }
        echo "Data User Berhasil Di Syncron <br/><br/>";

        $urlPegawai="http://localhost/sibening/api/getPegawai.php";
        $get_url_pegawai = file_get_contents($urlPegawai);
        $serverPegawai = json_decode($get_url_pegawai,true);
        $lokalPegawai = $this->peserta_model->getAllPeserta();        

        for ($i=0; $i < count($serverPegawai); $i++) { 

            if($i < count($lokalPegawai)){ //Update
                $dataUser = array(
                    'id_pegawai'  => $serverPegawai[$i]['id_pegawai'],
                    'nip'  => $serverPegawai[$i]['nip'],
                    'nama_pegawai'  => $serverPegawai[$i]['nama_pegawai'],
                    'tempat_lahir'  => $serverPegawai[$i]['tempat_lahir'],
                    'tgl_lahir'  => $serverPegawai[$i]['tgl_lahir'],
                    'jenis_kelamin'  => $serverPegawai[$i]['jenis_kelamin'],
                    'no_tlp'  => $serverPegawai[$i]['no_tlp'],
                    'email'  => $serverPegawai[$i]['email'],
                    'alamat'  => $serverPegawai[$i]['alamat'],
                    'agama'  => $serverPegawai[$i]['agama'],
                    'jabatan'  => $serverPegawai[$i]['jabatan'],
                    'bagian'  => $serverPegawai[$i]['bagian'],
                    'pendidikan'  => $serverPegawai[$i]['pendidikan'],
                    'status'  => $serverPegawai[$i]['status'],
                    'rumpun'  => $serverPegawai[$i]['rumpun'],
                    'pajak'  => $serverPegawai[$i]['pajak'],
                    'no_ktp'  => $serverPegawai[$i]['no_ktp'],
                    'npwp'  => $serverPegawai[$i]['npwp'],
                    'norek_dki'  => $serverPegawai[$i]['norek_dki'],
                    'status_pns'  => $serverPegawai[$i]['status_pns'],
                    'bpjs_ks'  => $serverPegawai[$i]['bpjs_ks'],
                    'bpjs_jkk'  => $serverPegawai[$i]['bpjs_jkk'],
                    'bpjs_ijht'  => $serverPegawai[$i]['bpjs_ijht'],
                    'bpjs_jp'  => $serverPegawai[$i]['bpjs_jp'],
                    'pj_cuti'  => $serverPegawai[$i]['pj_cuti'],
                    'foto_url'  => $serverPegawai[$i]['foto_url'],
                    'tgl_masuk'  => $serverPegawai[$i]['tgl_masuk'],
                    'tmt_gaji'  => $serverPegawai[$i]['tmt_gaji'],
                    'is_active'  => $serverPegawai[$i]['is_active'],
                    'tempat_tugas'  => $serverPegawai[$i]['tempat_tugas'],
                    'tempat_tugas_ket'  => $serverPegawai[$i]['tempat_tugas_ket'],
                    'shift_status'  => $serverPegawai[$i]['shift_status'],
                    'golongan'  => $serverPegawai[$i]['golongan'],
                    'nrk'  => $serverPegawai[$i]['nrk'],
                    'gelar_depan'  => $serverPegawai[$i]['gelar_depan'],
                    'gelar_belakang'  => $serverPegawai[$i]['gelar_belakang']
                );
                $this->peserta_model->updatePeserta($serverPegawai[$i]['id_pegawai'],$dataUser, 'm_pegawai');
                echo $i . " - " . $serverPegawai[$i]['nama_pegawai'] . " - Berhasil Diupdate<br/>";
            }else{//Insert
                $dataUser = array(
                    'id_pegawai'  => $serverPegawai[$i]['id_pegawai'],
                    'nip'  => $serverPegawai[$i]['nip'],
                    'nama_pegawai'  => $serverPegawai[$i]['nama_pegawai'],
                    'tempat_lahir'  => $serverPegawai[$i]['tempat_lahir'],
                    'tgl_lahir'  => $serverPegawai[$i]['tgl_lahir'],
                    'jenis_kelamin'  => $serverPegawai[$i]['jenis_kelamin'],
                    'no_tlp'  => $serverPegawai[$i]['no_tlp'],
                    'email'  => $serverPegawai[$i]['email'],
                    'alamat'  => $serverPegawai[$i]['alamat'],
                    'agama'  => $serverPegawai[$i]['agama'],
                    'jabatan'  => $serverPegawai[$i]['jabatan'],
                    'bagian'  => $serverPegawai[$i]['bagian'],
                    'pendidikan'  => $serverPegawai[$i]['pendidikan'],
                    'status'  => $serverPegawai[$i]['status'],
                    'rumpun'  => $serverPegawai[$i]['rumpun'],
                    'pajak'  => $serverPegawai[$i]['pajak'],
                    'no_ktp'  => $serverPegawai[$i]['no_ktp'],
                    'npwp'  => $serverPegawai[$i]['npwp'],
                    'norek_dki'  => $serverPegawai[$i]['norek_dki'],
                    'status_pns'  => $serverPegawai[$i]['status_pns'],
                    'bpjs_ks'  => $serverPegawai[$i]['bpjs_ks'],
                    'bpjs_jkk'  => $serverPegawai[$i]['bpjs_jkk'],
                    'bpjs_ijht'  => $serverPegawai[$i]['bpjs_ijht'],
                    'bpjs_jp'  => $serverPegawai[$i]['bpjs_jp'],
                    'pj_cuti'  => $serverPegawai[$i]['pj_cuti'],
                    'foto_url'  => $serverPegawai[$i]['foto_url'],
                    'tgl_masuk'  => $serverPegawai[$i]['tgl_masuk'],
                    'tmt_gaji'  => $serverPegawai[$i]['tmt_gaji'],
                    'is_active'  => $serverPegawai[$i]['is_active'],
                    'tempat_tugas'  => $serverPegawai[$i]['tempat_tugas'],
                    'tempat_tugas_ket'  => $serverPegawai[$i]['tempat_tugas_ket'],
                    'shift_status'  => $serverPegawai[$i]['shift_status'],
                    'golongan'  => $serverPegawai[$i]['golongan'],
                    'nrk'  => $serverPegawai[$i]['nrk'],
                    'gelar_depan'  => $serverPegawai[$i]['gelar_depan'],
                    'gelar_belakang'  => $serverPegawai[$i]['gelar_belakang']
                );
                $this->peserta_model->saveData($dataUser, 'm_pegawai');
                echo $i . " - " . $serverPegawai[$i]['nama_pegawai'] . " - Berhasil Ditambah<br/>";
            }
        }
        echo "Data Pegawai Berhasil Di Syncron <br/><br/>";

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
