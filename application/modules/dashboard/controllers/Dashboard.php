<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct() {

		//load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';

	}
	public function index()
	{

		// add breadcrumbs
		$data['breadcrumbs'] = array('Dashboard' => '/dashboard');

		echo Modules::run($this->template_main, $data);
	}

	public function member()
	{
		$data['breadcrumbs'] = array('Dashboard' => '/dashboard', 'Member' => '/dashboard/member');

		echo Modules::run($this->template_member, $data);
	}
}
