<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kpi extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model('kpi_model');
		$this->load->model('kpi_detail_model');
	}
	public function index()
	{
		$this->kpi_table();
	}


	public function kpi_table()
	{
		$table = $this->kpi_model->get_all();
		$data['breadcrumbs'] = array('KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/kpi-table';
		$data['kpis'] = $table;
		echo Modules::run($this->template_member, $data);
	}

	public function add_indicator($id_kpi)
	{
		$this->display_form_indikator($id_kpi);
	}

	public function save_indikator()
	{
		$id = $this->kpi_detail_model->from_form()->insert();
		if ($id) {
			$this->session->set_flashdata('success','Data Indikator berhasil disimpan');
			redirect($this->agent->referrer());
		}
	}

	public function delete_indikator($id_indikator)
	{
		$this->kpi_detail_model->delete($id_indikator);
		$this->session->set_flashdata('success','Data Indikator berhasil dihapus');
		redirect($this->agent->referrer(),'location');
	}

	public function display_form_indikator($id_kpi,$id_indikator=''){
		$data['breadcrumbs'] = array('KPI' => '/kpi/kpi','Kpi table'=>'/kpi');
		$data['content'] = 'kpi/form-kpi-indikator';
		$data['id_kpi'] = $id_kpi;
		$indikator='';
		if(!empty($id_indikator)){
			$indikator = $this->kpi_detail_model->get($id_indikator);
		}
		// var_dump($id_indikator);
		if(!empty($indikator)){
			$data['form']=[
				'sasaran' => $indikator->sasaran,
				'nama_indikator' => $indikator->nama_indikator,
				'bobot' => $indikator->bobot,
			];
		}else{
			$data['form']='';
		}
		$data['table_indikators'] = $this->kpi_detail_model->where('id_kpi', $id_kpi)->get_all();
		// var_dump($data['table_indikators']);
		// $data['kpis'] = $table;
		echo Modules::run($this->template_member, $data);
	}
	public function edit_indikator($id_kpi,$id_indikator){
		$this->display_form_indikator($id_kpi,$id_indikator);
	}
}
