<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MX_Controller {

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

		$this->load->view('main', $data);
	}

	public function user($data)
	{
		$data['header'] = 'template/header';
		$data['topbar'] = 'template/topbar';
		$data['sidebar'] = 'template/sidebar';
		$data['control_sidebar'] = 'template/control_sidebar';
		$data['content_header'] = 'template/content_header';
		//$data['content'] = 'template/content';
		$data['js'] = 'template/js';
		$data['footer'] = 'template/footer';

		$this->load->view('main', $data);
	}

}
