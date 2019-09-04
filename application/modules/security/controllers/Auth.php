<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct() {

		//load template here
		// $this->template_main = 'template/index';
		// $this->template_member = 'template/user';

	}
	public function index()
	{
		// echo "test";
		// add breadcrumbs
		// $data['breadcrumbs'] = array('Dashboard' => '/dashboard');

		// echo Modules::run($this->template_main, $data);
		$this->load->view('login');
	}

	public function check(){
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = ($this->input->post('remember')) ? true : false;
		// var_dump($email);
		// var_dump($password);
		// die();
		if (!$this->ion_auth->logged_in()){
			$ok = $this->ion_auth->login($email, $password, $remember);
			if($ok){
				redirect('/dashboard');
			}else{
				$this->session->set_flashdata('error', 'Email / Password anda salah.');
				redirect('/security/auth');
			}
		}

	}

	public function logout(){
		$this->ion_auth->logout();
		redirect('dashboard');
	}

}
