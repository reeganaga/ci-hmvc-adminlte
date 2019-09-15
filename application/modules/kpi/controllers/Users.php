<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		// $this->load->model('users_model');
		$this->menu='kpi-users';
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

	public function display_form_periode($id_periode_kpi = '')
	{
		$data['breadcrumbs'] = array('KPI' => '/kpi/kpi', 'Form periode' => '/kpi');
		$data['content'] = 'kpi/form-kpi-periode';
		$data['id_periode_kpi'] = $id_periode_kpi;
		$periode = '';
		if (!empty($id_periode_kpi)) {
			$periode = $this->periode_model->get($id_periode_kpi);
		}
		// var_dump($id_indikator);
		if (!empty($periode)) {
			$data['form'] = [
				'periode' => $periode->periode,
				'tgl_buka' => $periode->tgl_buka,
				'tgl_tutup' => $periode->tgl_tutup,
				'k_aktif' => $periode->k_aktif,
			];
		} else {
			$data['form'] = '';
		}
		// $data['table_indikators'] = $this->kpi_detail_model->where('id_kpi', $id_kpi)->get_all();
		// var_dump($data['table_indikators']);
		// $data['kpis'] = $table;
		$data['menu_active'] = $this->menu;

		echo Modules::run($this->template_member, $data);
	}

	public function edit($id_periode)
	{
		$this->display_form_periode($id_periode);
	}
}