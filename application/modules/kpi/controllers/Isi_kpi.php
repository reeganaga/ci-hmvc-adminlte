<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isi_kpi extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model(['periode_model', 'kpi_model','kpi_detail_model','penilaian_kpi_model']);
	}
	public function index()
	{
		$this->kpi_periode();
	}


	public function kpi_periode()
	{
		$periode = $this->periode_model->get_all();
		$data['breadcrumbs'] = array('Isi KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/kpi-periode-box';
		$data['data'] = $periode;
		$data['title'] = "Daftar periode aktif";
		$data['subtitle'] = "Silahkan pilih periode";
		echo Modules::run($this->template_member, $data);
	}

	public function ajax_kpi_list($id_periode_kpi)
	{
		$jenis_kpi = $this->kpi_model->get_all();
		// var_dump($jenis_kpi);
		$this->load->view('kpi/modal-content-jeniskpi', ['jenis_kpi' => $jenis_kpi, 'id_periode_kpi' => $id_periode_kpi]);
	}

	public function start($id_periode_kpi, $id_kpi_rev)
	{

		$kpi = $this->kpi_model->get($id_kpi_rev);
		$periode = $this->periode_model->get($id_periode_kpi);
		$title = ($kpi) ? $kpi->nama_kpi : "";
		$periode_ke = ($periode) ? $periode->periode : "";

		// var_dump($kpi);
		$data['breadcrumbs'] = array('Isi KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/form-isi-kpi';
		$data['id_periode_kpi'] = $id_periode_kpi;
		$data['title'] = $title;
		$data['kpi'] = $kpi;
		$data['indikator'] = $this->kpi_detail_model->where('id_kpi',$id_kpi_rev)->get_all();
		$data['subtitle'] = "Pengisian periode ke ".$periode_ke;
		echo Modules::run($this->template_member, $data);
	}

	public function proses_isi_kpi(){
		$post = $this->input->post();
		$user = $this->ion_auth->user();
		var_dump($user);
		foreach ($post['nilai'] as $value) {
			$data['id_periode_kpi']=$value['id_periode_kpi'];
			$data['id_kpi_rev']=$value['id_kpi_rev'];
			// $data['id_users']=;
			$data['id_kpi_rev']=$value['id_kpi_rev'];
		}
		// $this->penilaian_kpi_model->insert($data);
		// var_dump($post);
	}
}
