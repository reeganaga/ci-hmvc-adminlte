<?php defined('BASEPATH') or exit('No direct script access allowed');

class Template extends MY_Controller
{

	public $menus = [
		[
			'id' => 'kpi',
			'name' => "KPI",
			'uri' => "/kpi/kpi",
			'label' => "new",
			'icon' => 'fa fa-th',
			'role'=>[1]
		],
		[
			'id' => 'kpi-periode',
			'name' => "Periode",
			'uri' => "/kpi/periode",
			'label' => "new",
			'icon' => 'fa fa-calendar',
			'role'=>[1]
		],
		[
			'id' => 'kpi-isi-kpi',
			'name' => "Isi KPI",
			'uri' => "/kpi/isi_kpi",
			'label' => "new",
			'icon' => 'fa fa-pencil',
			'role'=>[1,2]
		],
		[
			'id' => 'kpi-users',
			'name' => "Users",
			'uri' => "/kpi/users",
			'label' => "new",
			'icon' => 'fa fa-users',
			'role'=>[1]
		],
	];

	public function index($data)
	{
		$data['header'] = 'template/header';
		$data['topbar'] = 'template/topbar';
		$data['sidebar'] = 'template/sidebar';
		$data['control_sidebar'] = 'template/control_sidebar';
		$data['content_header'] = 'template/content_header';
		$data['content'] = 'template/content';
		$data['js'] = 'template/js';
		$data['footer'] = 'template/footer';

		foreach ($data['breadcrumbs'] as $key => $value) {
			$this->breadcrumbs->push($key, $value);
		}

		$data['menus'] = $this->menus;
		$this->load->view('main', $data);
	}

	public function user($data)
	{
		$data['header'] = 'template/header';
		$data['topbar'] = 'template/topbar';
		$data['sidebar'] = 'template/sidebar';
		$data['control_sidebar'] = 'template/control_sidebar';
		$data['content_header'] = 'template/content_header';
		// $data['content'] = 'template/content';
		$data['js'] = 'template/js';
		$data['footer'] = 'template/footer';

		foreach ($data['breadcrumbs'] as $key => $value) {
			$this->breadcrumbs->push($key, $value);
		}

		$data['menus'] = $this->menus;

		$this->load->view('main', $data);
	}
}
