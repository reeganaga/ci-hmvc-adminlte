<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model(['users_model', 'provinces_model', 'regencies_model']);
		$this->menu = 'kpi-users';

		$this->set_groups([2]);
		parent::__construct();
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();
		$provinces = $this->provinces_model->get_all();
		$regencies = $this->regencies_model->where(['province_id' => $user->id_provinsi])->get_all();

		$data['breadcrumbs'] = array('Profile' => '/kpi/users');
		$data['content'] = 'kpi/kpi-user-form';
		$data['user'] = $user;
		$data['provinces'] = $provinces;
		$data['regencies'] = $regencies;
		$data['list_pendidikan'] = $this->users_model->pendidikan;
		$data['list_usaha'] = $this->users_model->jenis_usaha;
		$data['list_kelompok_usaha'] = $this->users_model->kelompok_usaha;
		$data['menu_active'] = $this->menu;
		// var_dump($data);
		echo Modules::run($this->template_member, $data);

		// $this->users_table();
	}

	public function ajax_get_regencies($id_province)
	{
		if (empty($id_province)) {
			$result = false;
		} else {
			$regencies = $this->regencies_model->as_array()->where(['province_id' => $id_province])->get_all();
			$result = $regencies;
		}
		// var_dump($result);

		echo json_encode($result);
	}


	public function save()
	{
		// $k_aktif = $this->input->post()==1;
		// var_dump($this->input->post());
		$user = $this->ion_auth->user()->row();
		$id_user = $user->id;

		//update
		$additional_data['id'] = $id_user;
		if (!$this->ion_auth->is_admin() && $user->active_admin == 0) {
			//set active admin 2 -> pending
			$additional_data['active_admin'] = 2;
		}
		// var_dump($additional_data);
		$id = $this->users_model->from_form(NULL, $additional_data)->update(null, ['id' => $id_user]);
		// var_dump($id);
		if ($id) {
			$this->session->set_flashdata('success', 'Data periode berhasil diupdate');
			redirect('/kpi/profile');
		} else {
			$this->index();
		}
	}




	public function save_password()
	{
		$post = $this->input->post();
		// var_dump($post);
		$password = $post['password'];
		$user = $this->ion_auth->user()->row();
		// var_dump($user->password);
		$id = $user->id;
		$originalPassword = $this->input->post('current_password');

		if ($this->ion_auth->verify_password($originalPassword, $user->password) == TRUE) {
			//shall pass
			// echo "true";
			//check password validation
			$this->form_validation->set_rules('password', 'Password', "min_length[6]|regex_match[/[A-Za-z]/]", [
				'min_length' => 'Minimal Password harus 6 karakter',
				'regex_match' => 'Password harus memiliki huruf',
				'numeric' => 'Password harus memiliki angka',
			]);
			if ($this->form_validation->run() == TRUE) {
				// var_dump("true");
				$data = array(
					'password' => $password,
				);
				$ok = $this->ion_auth->update($id, $data);
				if ($ok) {
					$this->session->set_flashdata('success', 'Password berhasil diupdate');
				} else {
					$this->session->set_flashdata('error', 'Password gagal diupdate, silahkan coba lagi');
				}
				redirect(base_url() . '/kpi/profile');
				//update password
			} else {
				$this->index();
				// echo "false";
			}
		} else {
			$this->session->set_flashdata('warning', 'Password sekarang salah');
			redirect(base_url() . '/kpi/profile');
		}
	}
}
