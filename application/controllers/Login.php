<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("Aauth");
		$this->load->model(array('peserta_model','course_model'));
		// if (!empty($this->session->userdata('username'))) {
		// 	redirect('dashboard');
		// }
	}

	public function index()
	{
		$this->load->library("Aauth");
		// echo "Session " . $this->session->userdata('username');
		if ($this->session->userdata('nip')) {
			$idpeserta = $this->session->userdata('id');
			$data['getcourse'] = $this->course_model->getCourse($idpeserta);
			$data['course'] = $this->course_model->allCourse();
			// $data['hasil'] = $this->course_model->getCourseHasilById('6');
			$this->load->view('course',$data);
		} else {
			$this->load->view('login');
		}
	}

	public function login()
	{
		// date_default_timezone_set('Asia/Jakarta');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$remember = "";

		$login = $this->aauth->login($username, $password, $remember);
		if ($login) {
			$perms = "member_login";
			$page = current_url();
			$comments = "Login Success with username : ". $username;
			$this->aauth->logit($perms,$page, $comments);
			redirect('course');
		} else {
			$perms = "member_login";
			$page = current_url();
			$comments = "Login attempt failed with username : ". $username;
			$this->aauth->logit($perms,$page, $comments);
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('messages', $this->aauth->get_errors_array());
			redirect('login');
		}		

		// $userdata = $this->peserta_model->getValidPeserta($username, md5($password));
		// // print_r($userdata);
		// // exit;
		// if ($userdata) {
		// 	$this->session->set_userdata($userdata[0]);
		// 	$login = array(
		// 		"lastlogin" => date("Y-m-d H:i:s")
		// 	);
		// 	$this->peserta_model->updateLastLogin($username, $login, 'mpeserta');
		// 	redirect('course');
		// } else {
		// 	redirect('login');
		// }
	}

	public function logout()
	{
		// $this->session->sess_destroy();
		// // $this->session->unset_userdata('username');
		// // $_SESSION = [];
		// redirect('login');

		$this->load->library("Aauth");
        $this->aauth->logout();
        redirect('login');
	}
}
