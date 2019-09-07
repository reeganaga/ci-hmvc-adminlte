<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

	function __construct()
	{

		//load template here
		// $this->template_main = 'template/index';
		// $this->template_member = 'template/user';

		$this->load->model('regencies_model');
	}
	public function index()
	{
		// echo "test";
		// add breadcrumbs
		// $data['breadcrumbs'] = array('Dashboard' => '/dashboard');

		// echo Modules::run($this->template_main, $data);
		$this->load->view('auth-template', ['page' => 'login']);
	}

	public function check()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$remember = ($this->input->post('remember')) ? true : false;
		// var_dump($email);
		// var_dump($password);
		// die();
		if (!$this->ion_auth->logged_in()) {
			$ok = $this->ion_auth->login($email, $password, $remember);
			if ($ok) {
				redirect('/dashboard');
			} else {
				$this->session->set_flashdata('error', 'Email / Password anda salah.');
				redirect('/security/auth');
			}
		}
	}

	public function logout()
	{
		$this->ion_auth->logout();
		redirect('dashboard');
	}

	public function register()
	{

		//process register
		if (!empty($username = $this->input->post('email'))) {
			$username = $this->input->post('email');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$additional_data = [
				'first_name' => $this->input->post('nama'),
				'tempat' => $this->input->post('tempat'),
				'id_kota' => $this->input->post('id_kota'),
			];
			$group = ['2']; //member

			$ok = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

			var_dump($ok);
			if ($ok) {
				$this->session->set_flashdata('success', 'Register berhasil, silahkan cek email anda untuk verifikasi');
				$message = $this->load->view('email-verification', $ok, true);
				$send = send_email($email, 'Registration KPI User', $message);
				var_dump($send);
			} else {
				$this->session->set_flashdata('error', 'Register Gagal, silahkan kontak admin atau coba lagi.');
			}
		}
		//get regency

		$regencies = $this->regencies_model->get_all();
		// var_dump($regencies);
		$this->load->view(
			'auth-template',
			[
				'page' => 'register',
				'data' => [
					'regencies' => $regencies
				]
			]
		);
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		$activation = FALSE;

		if ($code !== FALSE) {
			$activation = $this->ion_auth->activate($id, $code);
		} else if ($this->ion_auth->is_admin()) {
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation) {
			// redirect them to the auth page
			$this->session->set_flashdata('success', $this->ion_auth->messages());
			redirect("security/auth", 'refresh');
		} else {
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	public function forgot()
	{
		$this->load->view(
			'auth-template',
			[
				'page' => 'forgot',
			]
		);
	}
}
