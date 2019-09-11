<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isi_kpi extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model('periode_model');
	}
	public function index()
	{
		$this->kpi_periode();
	}


	public function kpi_periode(){
		$periode = $this->periode_model->get_all();
		$data['breadcrumbs'] = array('Isi KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/kpi-periode-box';
		$data['data'] = $periode;
		$data['title'] = "Daftar periode aktif";
		$data['subtitle'] = "Silahkan pilih periode";
		echo Modules::run($this->template_member, $data);
	}

	public function ajax_kpi_list()
	{
		echo "hello";
	}
}
