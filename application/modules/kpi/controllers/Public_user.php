<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Public_user extends MX_Controller
{

    function __construct()
    {

        // //load template here
        $this->template_main = 'template/index';
        $this->template_member = 'template/user';
        $this->load->model(['kpi_model', 'kpi_detail_model', 'penilaian_kpi_model', 'users_model', 'periode_model']);
        $this->menu = 'kpi-rekap';
        $this->title = 'Rekap';

        parent::__construct();
    }

    public function index()
    {
        // $this->rekap_public();
        show_404();
    }

    public function rekap($code)
    {

        
        $json = base64_decode($code);
        $param=[];
        $param = (array)json_decode($json);

        // var_dump($param);



        $user = $this->ion_auth->user()->row();
       
            // $data['content'] = 'kpi/kpi-rekap-table-public';
    
            
            // var_dump($param);
    
            $user = $this->ion_auth->user()->row();
            if (($user->active_admin == 0 || $user->active_admin == 2) && !$this->ion_auth->is_admin()) { // not verify
                $this->session->set_flashdata('warning', 'Akun anda perlu diaktifkan admin, Silahkan kontak Admin');
                $data['content'] = 'kpi/content-not-found';
            } else {
                $data['content'] = 'kpi/kpi-rekap-table-public';
            }
    
            if ($this->ion_auth->is_admin()) {
                $id_user = $param['id_user'];
            } else {
                $id_user = $this->ion_auth->user()->row()->id;
            }
            $data['id_user'] = $id_user;
    
           
    
            $data['id_periode'] = $param['id_periode'];
    
            $other_param = [];
            if (!empty($param['id_kpi_rev'])) {
                $other_param['id_kpi_rev'] = $param['id_kpi_rev'];
            }
            $data['id_kpi'] = $param['id_kpi_rev'];
            if (!empty($param['status'])) {
                $other_param['status'] = $param['status'];
            }
            $data['get_status'] = $param['status'];
            if (empty($id_user) && empty($param['id_periode'])) {
                $tables = false;
            } else {
                $tables = $this->penilaian_kpi_model->get_penilaian_rekap($id_user, $param['id_periode'], $other_param);
            }
            // var_dump($tables);die();
    
    
            //get data first
            $users = $this->users_model->get_all();
            $kpis = $this->kpi_model->get_all();
            $periodes = $this->periode_model->order_by('periode', 'asc')->get_all();
            $periode = $this->periode_model->get($param['id_periode']);
            $user = $this->users_model->with_regency()->with_province()->get($id_user);
            // var_dump($periodes);
    
            $data['users'] = $users;
            $data['kpis'] = $kpis;
            $data['data_user'] = $user;
            $data['periodes'] = $periodes;
            $data['data_periode'] = $periode;
            $data['breadcrumbs'] = array('KPI' => '/kpi/kpi');
            // $data['content'] = 'kpi/kpi-rekap-table';
            $data['tables'] = $tables;
            $data['menu_active'] = $this->menu;
            // var_dump($data);
            $data['title'] = $this->title;
    
            
            // generate qr code for public access
            // $key = 'M%k!fI7R7^hG';
            $code = base64_encode(json_encode($param));
            $data['code'] = base_url('kpi/public_user/rekap/'.$code);

        echo Modules::run("template/public", $data);
    }

}
