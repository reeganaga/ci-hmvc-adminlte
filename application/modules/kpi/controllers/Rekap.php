<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rekap extends MY_Controller
{

    function __construct()
    {

        // //load template here
        $this->template_main = 'template/index';
        $this->template_member = 'template/user';
        $this->load->model(['kpi_model', 'kpi_detail_model', 'penilaian_kpi_model', 'users_model', 'periode_model']);
        $this->menu = 'kpi-rekap';
        $this->title = 'Rekap';

        $this->set_groups([1, 2]);
        parent::__construct();
    }

    public function index()
    {
        $this->rekap_table();
    }

    public function rekap_table()
    {



        // $table = $this->kpi_model->get_all();
        // if (!$this->ion_auth->in_group('admin')) {
        // 	$user = $this->ion_auth->user()->row();
        // 	// var_dump($user);
        // 	$table = $this->penilaian_kpi_model->with_periode()->with_kpi()->with_user()->where('id_users', $user->id)->get_all();
        // } else {
        // 	$table = $this->penilaian_kpi_model->with_periode()->with_kpi()->with_user()->get_all();
        // }

        $param=[];
        $param['id_user'] = $this->input->get('id_user');
        $param['id_periode'] = $this->input->get('id_periode');
        $param['id_kpi_rev'] = $this->input->get('id_kpi_rev');
        $param['status'] = $this->input->get('status');
        // var_dump($param);

        $user = $this->ion_auth->user()->row();
        if (($user->active_admin == 0 || $user->active_admin == 2) && !$this->ion_auth->is_admin()) { // not verify
            $this->session->set_flashdata('warning', 'Akun anda perlu diaktifkan admin, Silahkan kontak Admin');
            $data['content'] = 'kpi/content-not-found';
        } else {
            $data['content'] = 'kpi/kpi-rekap-table';
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
        // $data['qr_code'] = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=".base_url('kpi/rekap/'.$code);
        // $data['qr_code'] = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".base_url('kpi/rekap/'.$code);

        echo Modules::run($this->template_member, $data);
    }

    public function ajax_chart_data()
    {
        // if (!$this->ion_auth->is_admin()) return;
        // var data = {
        //     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //     datasets: [{
        //         label: '# of Votes',
        //         data: [12, 19, 3, 5, 2, 3],
        //         backgroundColor: [
        //             'rgba(255, 99, 132, 0.2)',
        //             'rgba(54, 162, 235, 0.2)',
        //             'rgba(255, 206, 86, 0.2)',
        //             'rgba(75, 192, 192, 0.2)',
        //             'rgba(153, 102, 255, 0.2)',
        //             'rgba(255, 159, 64, 0.2)'
        //         ],
        //         borderColor: [
        //             'rgba(255, 99, 132, 1)',
        //             'rgba(54, 162, 235, 1)',
        //             'rgba(255, 206, 86, 1)',
        //             'rgba(75, 192, 192, 1)',
        //             'rgba(153, 102, 255, 1)',
        //             'rgba(255, 159, 64, 1)'
        //         ],
        //         borderWidth: 1
        //     }]
        // };


        if ($this->ion_auth->is_admin()) {
            $id_user = $this->input->get('id_user');
        } else {
            $id_user = $this->ion_auth->user()->row()->id;
        }
        // var_dump($id_user);
        $id_periode = $this->input->get('id_periode');

        $other_param=[];
        if (!empty($this->input->get('id_kpi_rev'))) {
            $other_param['id_kpi_rev']=$this->input->get('id_kpi_rev');
        }

        if (!empty($this->input->get('status'))) {
            $other_param['status']=$this->input->get('status');
        }
        // $id_kpi_rev = $this->input->get('id_kpi_rev');
        // $status = $this->input->get('status');

        // var_dump($id_periode);
        $penilaian_rekap = $this->penilaian_kpi_model->get_penilaian_rekap($id_user, $id_periode, $other_param);
        // var_dump($penilaian_rekap);
        $response = false;
        if ($penilaian_rekap) {
            // $count=[];
            $average = [];

            //loop and get all average score 
            foreach ($penilaian_rekap as $penilaian) {

                if (empty($average[$penilaian->id_kpi_rev])) {
                    $average[$penilaian->id_kpi_rev] = $penilaian->total_skor;
                } else {
                    // echo "<br> ".$average[$penilaian->id_kpi_rev]."   sebelunya <==<br>";
                    // echo "<br> ".$penilaian->total_skor."   ditambah ini terus dibagi 2 <==<br>";
                    $average[$penilaian->id_kpi_rev] = ($penilaian->total_skor + $average[$penilaian->id_kpi_rev]) / 2;
                }
                // echo "rata rata {$penilaian->kpi->nama_kpi} = {$average[$penilaian->id_kpi_rev]} <br>";


                // $summarize_kpi_score[$penilaian->id_kpi_rev] = $average;

                // echo $penilaian->id_kpi_rev;
                // echo "<br>";
                // echo $penilaian->total_skor;
                // echo "<br>";
                // echo $penilaian->kpi->nama_kpi;
                // echo "<br>";
                // echo "<br>===========<br>";
            }
            // var_dump($count);
            // var_dump($average);

            //get kpi
            $kpis = $this->kpi_model->get_all();
            $data = false;
            // var_dump($kpis);
            foreach ($kpis as $kpi) {
                if (isset($average[$kpi->id_kpi])) {
                    $data[] = $average[$kpi->id_kpi];
                } else $data[] = 0;

                $labels[] = $kpi->nama_kpi;
                // $this->penilaian_kpi_detail_model->get_summary_score($kpi->id_kpi);
            }
            $response['labels'] = $labels;
            $response['datasets'][] = [
                'label' => 'Rata - Rata',
                "backgroundColor" => "rgb(243, 156, 18)",
                "borderColor" => "rgb(243, 156, 18)",
                'data' => $data
            ];
        }
        $response = json_encode($response);
        echo $response;
        // var_dump($kpis);

    }
}
