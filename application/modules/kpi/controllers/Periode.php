<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Periode extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model('periode_model');
		$this->load->library('tampil/response');
		$this->load->helper('tampil_helper');
		$this->menu = 'kpi-periode';
		$this->title = 'Periode';

		$this->set_groups([1]);
		parent::__construct();
	}
	public function index()
	{

		$this->periode_table();
	}


	public function periode_table()
	{
		$table = $this->periode_model->get_all();
		$data['breadcrumbs'] = array('Periode' => '/kpi/periode');
		$data['content'] = 'kpi/kpi-periode-table';
		$data['tables'] = $table;
		$data['title'] = $this->title;
		$data['menu_active'] = $this->menu;


		echo Modules::run($this->template_member, $data);
	}

	public function add()
	{
		$this->display_form_periode();
	}

	public function add_ajax()
	{
		// $modul, $controller, $function
		// $data['modul']='kpi';
		// $data['controller']='periode';
		// $data['function']='';
		// echo modal('kpi','periode','add');
		Modules::run('tampil/modal/set_modal', 'kpi', 'periode', 'add');
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
				$this->response->reload_page();
				$this->response->send();
				// redirect('/kpi/periode');
			} else {
				alert('error', form_error('id_periode_kpi'));
				alert('error', form_error('periode'));
				alert('error', form_error('tgl_buka'));
				alert('error', form_error('tgl_tutup'));
				// $this->display_form_periode($id_periode_kpi);
			}
		} else {
			//insert
			$id = $this->periode_model->from_form(null, ['k_aktif' => $k_aktif])->insert();
			if ($id) {
				$this->session->set_flashdata('success', 'Data periode berhasil disimpan');
				// redirect('/kpi/periode');
				$this->response->reload_page();
				$this->response->send();
			} else {

				$error = alert('error', form_error('id_periode_kpi'),true);
				$error .= alert('error', form_error('periode'),true);
				$error .= alert('error', form_error('tgl_buka'),true);
				$error .= alert('error', form_error('tgl_tutup'),true);
				$this->response->script($error);
				$this->response->send();
				// $this->display_form_periode();
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
		$data['title'] = $this->title;



		$this->load->view($data['content'], $data);
		// echo Modules::run($this->template_member, $data);
	}

	public function edit($id_periode)
	{
		$this->display_form_periode($id_periode);
	}
}
