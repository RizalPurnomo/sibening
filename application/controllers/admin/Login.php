<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('user_model'));
		// if (!empty($this->session->userdata('nip'))) {
		// 	redirect('admin/dashboard');
		// }
		$this->load->library("Aauth");
		// if (!$this->aauth->is_loggedin()) {
		//     $this->session->set_flashdata('message_type', 'error');
		//     $this->session->set_flashdata('messages', 'Please login first.');
		//     redirect('admin/login');
		// }        

	}

	public function index()
	{
		$this->load->library("Aauth");
		// echo "Session " . $this->session->userdata('username');
		if ($this->session->userdata('nip')) {
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
		$remember = "";

		$login = $this->aauth->login($username, $password, $remember);
		if ($login) {
			$perms = "Admin_login";
			$page = current_url();
			$comments = "Admin Login Success with username : " . $username;
			$this->aauth->logit($perms, $page, $comments);
			$logn =  $this->session->userdata('learning');
			// print_r($this->session->userdata());
			// exit;
			if ($logn == '1') {
				redirect('admin/dashboard');
			} else {
				$this->logout();
			}
			// exit;
		} else {
			$perms = "Admin_login";
			$page = current_url();
			$comments = "Admin Login attempt failed with username : " . $username;
			$this->aauth->logit($perms, $page, $comments);
			$this->session->set_flashdata('message_type', 'error');
			$this->session->set_flashdata('messages', $this->aauth->get_errors_array());
			redirect('admin/login');
		}

		// $userdata = $this->user_model->getValidUser($username, md5($password));
		// if ($userdata) {
		// 	$this->session->set_userdata($userdata[0]);
		// 	$login = array(
		// 		"lastlogin" => date("Y-m-d H:i:s")
		// 	);
		// 	$this->user_model->updateLastLogin($username, $login, 'muser');
		// 	redirect('admin/dashboard');
		// } else {
		// 	redirect('admin/login');
		// }
	}

	public function logout()
	{
		// $this->session->sess_destroy();
		// // $this->session->unset_userdata('username');
		// // $_SESSION = [];
		// redirect('admin/login');

		$this->load->library("Aauth");
		$this->aauth->logout();
		redirect('admin/login');
	}
}
