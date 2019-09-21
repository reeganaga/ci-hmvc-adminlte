<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Isi_kpi extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model(['periode_model', 'kpi_model', 'kpi_detail_model', 'penilaian_kpi_model', 'penilaian_kpi_detail_model']);
		$this->menu = 'kpi-isi-kpi';
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

		$jenis_kpi = $this->kpi_model->get_filled_kpi($id_periode_kpi);
		// var_dump($jenis_kpi);
		// $
		$this->load->view('kpi/modal-content-jeniskpi', ['jenis_kpi' => $jenis_kpi, 'id_periode_kpi' => $id_periode_kpi]);
	}

	public function start($id_periode_kpi, $id_kpi_rev)
	{

		$kpi = $this->kpi_model->get($id_kpi_rev);
		$periode = $this->periode_model->get($id_periode_kpi);
		$title = ($kpi) ? $kpi->nama_kpi : "";
		$periode_ke = ($periode) ? "<b>".$periode->periode."</b>" : "";

		$penilaian = $this->penilaian_kpi_model->get(['id_periode_kpi' => $id_periode_kpi, 'id_kpi_rev' => $id_kpi_rev]);
		if ($this->ion_auth->in_group('members')) {
			if ($penilaian && $penilaian->status == 2) {
				$editable = false;
			} else {
				$editable = true;
			}
		} else {
			$editable = true;
		}

		if ($penilaian) {
			// var_dump($penilaian);
			$penilaian_label = ($penilaian->status == 1) ? "<span class='label label-warning'>Pending</span>" : "<span class='label label-success'>Verified</span>";
		}else $penilaian_label="";

		$data_penilaian = $this->penilaian_kpi_model->get_penilaian_by_kpi($id_kpi_rev, $id_periode_kpi);
		// var_dump($data_penilaian);
		// die();
		$data['editable'] = $editable;
		$data['breadcrumbs'] = array('Isi KPI' => '/kpi/kpi');
		$data['content'] = 'kpi/form-isi-kpi';
		$data['id_periode_kpi'] = $id_periode_kpi;
		$data['title'] = $title;
		$data['kpi'] = $kpi;
		$data['indikator'] = $this->kpi_detail_model->as_object()->where('id_kpi', $id_kpi_rev)->get_all();
		$data['subtitle'] = "Pengisian periode ke " . $periode_ke . " " . $penilaian_label;
		$data['data_penilaian'] = $data_penilaian;
		$data['menu_active'] = $this->menu;
		echo Modules::run($this->template_member, $data);
	}

	public function proses_isi_kpi()
	{
		$post = $this->input->post();
		// var_dump($post);
		$user = $this->ion_auth->user()->row();
		$user_id = $user->id;
		// var_dump($user);
		$kpi = $this->kpi_model->get($post['id_kpi_rev']);
		$kpi_name = "";
		if ($kpi) {
			$kpi_name = $kpi->nama_kpi;
		}
		//insert to tb penilaian
		$data_penilaian = [
			'id_periode_kpi' => $post['id_periode_kpi'],
			'id_users' => $user_id,
			'id_kpi_rev' => $post['id_kpi_rev'],
			'status' => 1, // set pending first
		];

		//check already inserted or not
		$check_penilaian = $this->penilaian_kpi_model->as_array()->get($data_penilaian);
		// var_dump($check_penilaian);
		// die();
		if ($check_penilaian) {
			//has data, so update
			$insert = false;
			// var_dump($check_penilaian);
			$id_penilaian = $check_penilaian['id'];
			// die();
		} else {
			//empty , so insert
			$id_penilaian = $this->penilaian_kpi_model->insert($data_penilaian);
			$insert = true;
			// var_dump($id_penilaian);
			// die();
		}
		if ($id_penilaian) {
			foreach ($post['nilai'] as $id => $value) {
				$data['id_kpi_detail_rev'] = $id;
				// $data['id_periode_kpi']=$post['id_periode_kpi'];
				$data['id_penilaian_kpi'] = $id_penilaian;
				// $data['id_kpi_rev']=$post['id_kpi_rev'];
				// $data['id_users']=$user->id;
				$data['nilai_target'] = $value['target'];
				$data['nilai_realisasi'] = $value['realisasi'];

				//calculate score
				$kpi_detail = $this->kpi_detail_model->get($id);
				$bobot = $kpi_detail->bobot;
				$score = calculate_score($value['realisasi'], $value['target'], $bobot);
				// var_dump($score);

				$data['skor'] = $score['score'];
				$data['skor_akhir'] = $score['end_score'];
				// var_dump($data);
				//insert table pengisian
				if ($insert) {
					//insert kpi detail
					$ok = $this->penilaian_kpi_detail_model->insert($data);
				} else {
					//update kpi detail
					// var_dump($data);
					// var_dump($id_penilaian);
					$ok = $this->penilaian_kpi_detail_model->update($data, [
						'id_penilaian_kpi' => $id_penilaian,
						'id_kpi_detail_rev' => $id
					]);
					// $this->_database->last_query();
					// var_dump($ok);
				}
				// var_dump($ok);
			}
		}
		// die();




		$this->session->set_flashdata('success', "KPI {$kpi_name} berhasil disimpan");
		redirect($this->agent->referrer());
		// $this->penilaian_kpi_model->insert($data);
		// var_dump($post);
	}
}
