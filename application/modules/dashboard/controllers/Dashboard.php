<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {


	public function __construct()
  {
		parent::__construct();
		
		//load template here
    $this->template_main = 'template/index';
		$this->template_member = 'template/user';
  }

	public function index()
	{
		$data = '';
		echo Modules::run($this->template_main, $data);
	}

	public function member()
	{
		$data = '';
		echo Modules::run($this->template_member, $data);
	}
}
