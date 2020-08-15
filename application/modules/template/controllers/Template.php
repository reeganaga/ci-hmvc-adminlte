<?php defined('BASEPATH') or exit('No direct script access allowed');

class Template extends MY_Controller
{

	public $menus = [
		[
			'id' => 'kelompok',
			'name' => "Kelompok",
			'uri' => "pendaftaran/kelompok",
			'label' => "new",
			'icon' => 'fa fa-th',
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

	public function public($data){
		$data['header'] = 'template/header';
		$data['js'] = 'template/js';
		// $data['footer'] = 'template/footer';

		foreach ($data['breadcrumbs'] as $key => $value) {
			$this->breadcrumbs->push($key, $value);
		}

		$data['menus'] = $this->menus;

		$this->load->view('main_public', $data);

	}
}
