<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

  public function __construct()
  {
		parent::__construct();

    // load Breadcrumbs
    $this->load->library('breadcrumbs');

    //check login
    if(!$this->ion_auth->logged_in()){
      redirect('security/auth');
      // $this->login();
    }

  }
  

}
