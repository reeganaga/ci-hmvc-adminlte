<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kelompok extends MY_Controller {

    function __construct() {

        // //load template here
        $this->template_main = 'template/index';
        $this->template_member = 'template/user';
        $this->menu = 'kelompok';
        $this->title="Kelompok";

        $this->set_groups([1]);
		parent::__construct();
    }

    public function index(){
        $data['breadcrumbs'] = array('Isi KPI' => '/kpi/kpi');
        $data['title'] = "Daftar periode aktif";
        $data['subtitle'] = "Silahkan pilih periode";
        $data['menu_active'] = $this->menu;

        $data['content'] = 'pendaftaran/table-kelompok';


        echo Modules::run($this->template_member, $data);
    }
}