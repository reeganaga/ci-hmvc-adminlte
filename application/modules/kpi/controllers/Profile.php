<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends MY_Controller
{

	function __construct()
	{

		// //load template here
		$this->template_main = 'template/index';
		$this->template_member = 'template/user';
		$this->load->model(['users_model', 'provinces_model', 'regencies_model']);
		$this->menu = 'kpi-users';
		$this->title = 'Profile';

		$this->upload_path = 'uploads/';
		$this->ext_permit = 'jpg|png|jpeg';


		$this->set_groups([2]);
		parent::__construct();
	}

	public function index()
	{
		$user = $this->ion_auth->user()->row();
		$provinces = $this->provinces_model->get_all();
		$regencies = $this->regencies_model->where(['province_id' => $user->id_provinsi])->get_all();

		$data['breadcrumbs'] = array('Profile' => '/kpi/users');
		$data['content'] = 'kpi/kpi-user-form';
		$data['user'] = $user;
		$data['provinces'] = $provinces;
		$data['regencies'] = $regencies;
		$data['list_pendidikan'] = $this->users_model->pendidikan;
		$data['list_usaha'] = $this->users_model->jenis_usaha;
		$data['list_kelompok_usaha'] = $this->users_model->kelompok_usaha;
		$data['menu_active'] = $this->menu;
		// var_dump($data);
		$data['title'] = $this->title;
		echo Modules::run($this->template_member, $data);

		// $this->users_table();
	}

	public function ajax_get_regencies($id_province)
	{
		if (empty($id_province)) {
			$result = false;
		} else {
			$regencies = $this->regencies_model->as_array()->where(['province_id' => $id_province])->get_all();
			$result = $regencies;
		}
		// var_dump($result);

		echo json_encode($result);
	}


	public function save()
	{
		// $k_aktif = $this->input->post()==1;
		$user = $this->ion_auth->user()->row();
		// var_dump($user);die();
		$id_user = $user->id;

		//update
		$additional_data['id'] = $id_user;
		if (!$this->ion_auth->is_admin() && $user->active_admin == 0) {
			//set active admin 2 -> pending
			$additional_data['active_admin'] = 2;
		}

		//modify date
		$cur_date = $this->input->post('tgl_lahir');
		$additional_data['tgl_lahir'] = convert_date_format($cur_date);

		//modify omset
		$cur_date = $this->input->post('omset');
		$additional_data['omset'] = str_replace(".", "", $cur_date);

		// var_dump($this->input->post());
		// var_dump($additional_data);

		//upload photo
		$foto_tmp = (!empty($_FILES['foto'])) ? $_FILES['foto'] : '';
		// var_dump($foto_tmp);
		if (!empty($foto_tmp['name'])) {
			$old_file = (!empty($user->foto)) ? $user->foto : ""; 
			// var_dump($this->upload_path);
			// die();
			$upload = upload_file($this->upload_path, 'foto', $old_file, $this->ext_permit, '', true);
			// var_dump($upload);
			// die();
			if (is_array($upload)) {
				$additional_data['foto'] = $upload['file_name'];
			}else{
				$this->session->set_flashdata('error', $upload);
			}
		}
		// var_dump($additional_data);


		// die();
		$id = $this->users_model->from_form(NULL, $additional_data)->update(null, ['id' => $id_user]);
		// var_dump($id);
		if ($id) {
			$this->session->set_flashdata('success', 'Data periode berhasil diupdate');
			redirect('/kpi/profile');
		} else {
			$this->index();
		}
	}




	public function save_password()
	{
		$post = $this->input->post();
		// var_dump($post);
		$password = $post['password'];
		$user = $this->ion_auth->user()->row();
		// var_dump($user->password);
		$id = $user->id;
		$originalPassword = $this->input->post('current_password');

		if ($this->ion_auth->verify_password($originalPassword, $user->password) == TRUE) {
			//shall pass
			// echo "true";
			//check password validation
			$this->form_validation->set_rules('password', 'Password', "min_length[6]|regex_match[/[A-Za-z]/]", [
				'min_length' => 'Minimal Password harus 6 karakter',
				'regex_match' => 'Password harus memiliki huruf',
				'numeric' => 'Password harus memiliki angka',
			]);
			if ($this->form_validation->run() == TRUE) {
				// var_dump("true");
				$data = array(
					'password' => $password,
				);
				$ok = $this->ion_auth->update($id, $data);
				if ($ok) {
					$this->session->set_flashdata('success', 'Password berhasil diupdate');
				} else {
					$this->session->set_flashdata('error', 'Password gagal diupdate, silahkan coba lagi');
				}
				redirect(base_url() . '/kpi/profile');
				//update password
			} else {
				$this->index();
				// echo "false";
			}
		} else {
			$this->session->set_flashdata('warning', 'Password sekarang salah');
			redirect(base_url() . '/kpi/profile');
		}
	}

	public function get_foto($user_id = '')
	{
		// get_file($type,$id);
		$base_file = FCPATH.'uploads/';

		$user = $this->ion_auth->user()->row();
		if($user_id!==$user->id) show_404();

		if (empty($user)) {
			show_404(); //user should login
		}
		$filename = $this->users_model->fields('foto')->get($user_id);
		if ($filename) {
			$filename = $filename->foto;
			$path = $base_file . $filename;
		}
		
		// echo $path; die();
		if (empty($path)) show_404();
		
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		// $fileurl = $path.$filename;
		switch ($ext) {
			case 'png':
				$content_type = 'image/png';
			break;
			case 'jpeg':
				case 'jpg':
					case 'JPG':
						$content_type = 'image/jpeg';
					break;
					case 'pdf':
						$content_type = 'application/pdf';
					break;
					case 'doc':
						case 'docx';
						$content_type = 'application/msword';
					break;
					default:
					# code...
				break;
			}
			//"image/jpeg","image/png","application/pdf","application/msword"
			// echo $ext;
			// include $fileurl;
			if (!file_exists($path)) show_404();
			if (empty($content_type)) show_404();
			// echo $path;
			// var_dump($filename);
			// die();
			
			header("Content-type:" . $content_type);
			header('Content-Disposition: inline; filename=' . $filename);
			readfile($path);
		}
	}
