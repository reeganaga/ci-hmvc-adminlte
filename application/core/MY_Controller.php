<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends MX_Controller
{

  public $access_group = [];

  public function __construct()
  {
    parent::__construct();

    // load Breadcrumbs
    $this->load->library('breadcrumbs');

    //check login
    if (!$this->ion_auth->logged_in()) {
      redirect('security/auth');
      // $this->login();
    }

    //check controller permited{
    $this->permited_controller();
  }

  public function permited_controller()
  {
    // var_dump($this->access_group);
    if (empty($this->access_group)) {
      // echo "empty";
      $is_allowed = true;
    } else {
      $is_allowed = $this->ion_auth->in_group($this->access_group);
    }

    // var_dump($is_allowed);
    // var_dump($this->access_group);
    if(!$is_allowed){
      $this->session->set_flashdata('error','Anda tidak diijinkan membuka halaman ini');
      redirect(base_url('dashboard'));
    }
    // var_dump($is_allowed);
  }

  public function set_groups($groups)
  {
    $this->access_group = $groups;
    // var_dump($this->access_group);
  }
}
