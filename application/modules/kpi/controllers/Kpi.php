<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends MY_Controller {

	function __construct() {

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model('kpi_model');

	}
	public function index()
	{
		$this->kpi_table();
	}
	
	public function display_kpi_table($output){
		// var_dump($output);
		// add breadcrumbs
		$data['breadcrumbs'] = array('KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/kpi-table';
		$data['table'] = (array) $output;
		echo Modules::run($this->template_member, $data);
	}

	public function kpi_table()
	{
		$table = $this->kpi_model->get_all();
		// var_dump($table);
		$data['breadcrumbs'] = array('KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/kpi-table';
		$data['kpis'] = $table;
		echo Modules::run($this->template_member, $data);
	}
}
