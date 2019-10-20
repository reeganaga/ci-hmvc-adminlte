<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model('users_model');
		$this->menu='kpi-users';
		$this->title='Users';

		$this->set_groups([1]);
		parent::__construct();
	}
	public function index()
	{
		$this->users_table();
	}


	public function users_table()
	{
		$table = $this->ion_auth->users()->result();
		// var_dump($table);
		// die();
		$data['breadcrumbs'] = array('Users' => '/kpi/users');
		$data['content'] = 'kpi/kpi-users-table';
		$data['tables'] = $table;
		$data['title'] = $this->title;
		$data['menu_active'] = $this->menu;
		echo Modules::run($this->template_member, $data);
	}

	public function add()
	{
		$this->display_form_periode();
	}

	public function save()
	{
		// $k_aktif = $this->input->post()==1;
		$k_aktif = !empty($this->input->post('k_aktif')) ? $this->input->post('k_aktif') : 0;
		// var_dump($this->input->post());
		// var_dump($k_aktif);
		// die();

		$id_periode_kpi = $this->input->post('id_periode_kpi');
		//save or update
		if (!empty($id_periode_kpi)) {
			//update
			$id = $this->periode_model->from_form(null, ['k_aktif' => $k_aktif])->update();
			if ($id) {
				$this->session->set_flashdata('success', 'Data periode berhasil diupdate');
				redirect('/kpi/periode');
			}else{
				$this->display_form_periode($id_periode_kpi);
			}
		} else {
			//insert
			$id = $this->periode_model->from_form(null, ['k_aktif' => $k_aktif])->insert();
			if ($id) {
				$this->session->set_flashdata('success', 'Data periode berhasil disimpan');
				redirect('/kpi/periode');
			}else{
				$this->display_form_periode();
			}
		}
	}

	public function delete($id_indikator)
	{
		$this->kpi_detail_model->delete($id_indikator);
		$this->session->set_flashdata('success', 'Data Indikator berhasil dihapus');
		redirect($this->agent->referrer(), 'location');
	}

	public function display_form_user($id = '')
	{
		$data['breadcrumbs'] = array('KPI' => '/kpi/users', 'Form user' => '/kpi');
		$data['content'] = 'kpi/form-user';
		$data['id'] = $id;
		$user = '';
		if (!empty($id)) {
			$user = $this->users_model->get($id);
		}
		// var_dump($user);
		if (!empty($user)) {
			$data['form'] = [
				'email' => $user->email,
				'first_name' => $user->first_name,
				'tempat' => $user->tempat,
				'id_kota' => $user->id_kota,
			];
		} else {
			$data['form'] = '';
		}
		// $data['table_indikators'] = $this->kpi_detail_model->where('id_kpi', $id_kpi)->get_all();
		// var_dump($data['table_indikators']);
		// $data['kpis'] = $table;
		$data['menu_active'] = $this->menu;
		$data['title'] = $this->title;
		echo Modules::run($this->template_member, $data);
	}

	public function edit($id_user)
	{
		$this->display_form_user($id_user);
	}

	public function active_deactive_user($id_user,$method){
		if (in_array($method,['active','deactive'])) {

			$status = ($method=='active')?1:0;
			$msg = ($method=='active')?'diaktifkan':"dinonaktifkan";
			$update = $this->users_model->update(['active_admin'=>$status],$id_user);
			if($update){
				$this->session->set_flashdata('success','User berhasil '.$msg);
			}else{
				$this->session->set_flashdata('error','User gagal '.$msg);
			}
		}
		redirect(base_url('/kpi/users'));
	}


	public function view($id_user){
		$user = $this->users_model->with_regency()->get($id_user);

		$data['breadcrumbs'] = array('Users' => '/kpi/users',$id_user=>"/kpi/users/view/{$id_user}");
		$data['content'] = 'kpi/kpi-users-view';
		$data['user'] = $user;
		$data['menu_active'] = $this->menu;
		$data['title'] = $this->title;
		echo Modules::run($this->template_member, $data);
	}
}
