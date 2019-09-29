<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends MY_Controller {

    function __construct() {

        // //load template here
        $this->template_main = 'template/index';
        $this->template_member = 'template/user';
        $this->load->model(['kpi_model','kpi_detail_model','penilaian_kpi_model','users_model','periode_model']);
        $this->menu = 'kpi-rekap';

        $this->set_groups([1]);
		parent::__construct();
    }

    public function index() {
        $this->rekap_table();
    }

    public function rekap_table() {

        

        // $table = $this->kpi_model->get_all();
        // if (!$this->ion_auth->in_group('admin')) {
		// 	$user = $this->ion_auth->user()->row();
		// 	// var_dump($user);
		// 	$table = $this->penilaian_kpi_model->with_periode()->with_kpi()->with_user()->where('id_users', $user->id)->get_all();
		// } else {
		// 	$table = $this->penilaian_kpi_model->with_periode()->with_kpi()->with_user()->get_all();
        // }

        $id_user = $this->input->get('id_user');
        $data['id_user'] = $id_user;
        
        $id_periode = $this->input->get('id_periode');
        $data['id_periode'] = $id_periode;
        // var_dump($id_user);
        $tables = $this->penilaian_kpi_model->get_penilaian_rekap($id_user,$id_periode);
        // var_dump($tables);die();


        //get data first
        $users = $this->users_model->get_all();
        $periodes = $this->periode_model->get_all();

        // var_dump($periodes);

        $data['users'] = $users;
        $data['periodes'] = $periodes;
        $data['breadcrumbs'] = array('KPI' => '/kpi/kpi');
        $data['content'] = 'kpi/kpi-rekap-table';
        $data['tables'] = $tables;
        $data['menu_active'] = $this->menu;
        echo Modules::run($this->template_member, $data);
    }


    

}
