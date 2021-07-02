<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('peserta_model'));
		// if (!empty($this->session->userdata('username'))) {
		// 	redirect('dashboard');
		// }
	}

	public function index()
	{
		// echo "Session " . $this->session->userdata('username');
		if ($this->session->userdata('email')) {
			$this->load->view('dashboard');
		} else {
			$this->load->view('login');
		}
	}

	public function login()
	{
		date_default_timezone_set('Asia/Jakarta');
		$email = $this->input->post('email');
		$password = $this->input->post('password');


		$userdata = $this->peserta_model->getValidPeserta($email, md5($password));
		if ($userdata) {
			$this->session->set_userdata($userdata[0]);
			$login = array(
				"lastlogin" => date("Y-m-d H:i:s")
			);
			$this->peserta_model->updateLastLogin($email, $login, 'mpeserta');
			redirect('dashboard');
		} else {
			redirect('login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		// $this->session->unset_userdata('username');
		// $_SESSION = [];
		redirect('login');
	}
}
