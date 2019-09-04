<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kpi extends MY_Controller {

	function __construct() {

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';

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
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('tb_kpi_rev');
			$crud->set_subject('KPI Table');
			$crud->required_fields('nama_kpi');
			$crud->columns('nama_kpi');

			$output = $crud->render();

			$this->display_kpi_table($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}

	}
}
