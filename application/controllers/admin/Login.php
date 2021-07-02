<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model'));
		if (!empty($this->session->userdata('username'))) {
			redirect('admin/dashboard');
		}
	}

	public function index()
	{
		// echo "Session " . $this->session->userdata('username');
		if ($this->session->userdata('username')) {
			$this->load->view('admin/dashboard');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function login()
	{
		date_default_timezone_set('Asia/Jakarta');
		$username = $this->input->post('username');
		$password = $this->input->post('password');


		$userdata = $this->user_model->getValidUser($username, md5($password));
		if ($userdata) {
			$this->session->set_userdata($userdata[0]);
			$login = array(
				"lastlogin" => date("Y-m-d H:i:s")
			);
			$this->user_model->updateLastLogin($username, $login, 'muser');
			redirect('admin/dashboard');
		} else {
			redirect('admin/login');
		}
	}

	// public function logout()
	// {
	// 	$this->session->sess_destroy();
	// 	// $this->session->unset_userdata('username');
	// 	// $_SESSION = [];
	// 	redirect('login');
	// }
}
