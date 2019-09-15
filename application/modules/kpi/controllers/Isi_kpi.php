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
		$this->menu='kpi-isi-kpi';
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
		$data['menu_active'] = $this->menu;
		echo Modules::run($this->template_member, $data);
	}

	public function ajax_kpi_list($id_periode_kpi)
	{
		// $jenis_kpi = $this->kpi_model->as_array()->get_all();

		$jenis_kpi = $this->kpi_model->get_filled_kpi();
		// var_dump($jenis_kpi);
		// $
		$this->load->view('kpi/modal-content-jeniskpi', ['jenis_kpi' => $jenis_kpi, 'id_periode_kpi' => $id_periode_kpi]);
	}

	public function start($id_periode_kpi, $id_kpi_rev)
	{

		$kpi = $this->kpi_model->get($id_kpi_rev);
		$periode = $this->periode_model->get($id_periode_kpi);
		$title = ($kpi) ? $kpi->nama_kpi : "";
		$periode_ke = ($periode) ? $periode->periode : "";

		$data_penilaian = $this->penilaian_kpi_model->get_penilaian_by_kpi($id_kpi_rev,$id_periode_kpi);
		// var_dump($data_penilaian);
		$data['breadcrumbs'] = array('Isi KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/form-isi-kpi';
		$data['id_periode_kpi'] = $id_periode_kpi;
		$data['title'] = $title;
		$data['kpi'] = $kpi;
		$data['indikator'] = $this->kpi_detail_model->as_object()->where('id_kpi',$id_kpi_rev)->get_all();
		$data['subtitle'] = "Pengisian periode ke ".$periode_ke;
		$data['data_penilaian'] = $data_penilaian;
		$data['menu_active'] = $this->menu;
		echo Modules::run($this->template_member, $data);
	}

	public function proses_isi_kpi(){
		$post = $this->input->post();
		// var_dump($post);
		$user = $this->ion_auth->user()->row();
		// var_dump($user);
		$kpi = $this->kpi_model->get($post['id_kpi_rev']);
		$kpi_name="";
		if($kpi){
			$kpi_name = $kpi->nama_kpi;
		}
		foreach ($post['nilai'] as $id => $value) {
			$data['id_periode_kpi']=$post['id_periode_kpi'];
			$data['id_kpi_rev']=$post['id_kpi_rev'];
			$data['id_users']=$user->id;
			$data['id_kpi_detail_rev']=$id;
			$data['nilai_target']=$value['target'];
			$data['nilai_realisasi']=$value['realisasi'];

			//calculate score
			$kpi_detail = $this->kpi_detail_model->get($id);
			$bobot = $kpi_detail->bobot;
			$score = calculate_score($value['realisasi'],$value['target'],$bobot);
			// var_dump($score);

			$data['skor'] = $score['score'];
			$data['skor_akhir'] = $score['end_score'];
			// var_dump($data);
			//insert table pengisian
			$ok = $this->penilaian_kpi_model->insert($data);
			// var_dump($ok);
		}

		$this->session->set_flashdata('success','KPI {$kpi_name} berhasil disimpan');
		redirect($this->agent->referrer());
		// $this->penilaian_kpi_model->insert($data);
		// var_dump($post);
	}
}
