<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends MY_Controller
{

    function __construct()
    {

        //load template here
        // $this->template_main = 'template/index';
        // $this->template_member = 'template/user';

        $this->load->model('regencies_model');
        $this->load->library('curl');
        $this->load->helper('captcha');
    }

    public function generate_captcha()
    {
        // init captcha
        $vals = array(
            // 'word'          => 'Random word',
            'img_path'      => './captcha/',
            'img_url'       => base_url().'captcha/',
            // 'font_path'     => './path/to/fonts/texb.ttf',
            'img_width'     => '150',
            'img_height'    => 30,
            'expiration'    => 7200,
            'word_length'   => 5,
            'font_size'     => 16,
            'img_id'        => 'Imageid',
            'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

            // White background and border, black text and red grid
            'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );

        // var_dump($vals);
        $cap = create_captcha($vals);
        return $cap;
    }
    public function index()
    {
        // echo "test";
        // add breadcrumbs
        // $data['breadcrumbs'] = array('Dashboard' => '/dashboard');
        // echo Modules::run($this->template_main, $data);


        
        $cap = $this->generate_captcha();
        // var_dump($cap);
        $data = array(
            'captcha_time'  => $cap['time'],
            'ip_address'    => $this->input->ip_address(),
            'word'          => $cap['word']
        );

        $query = $this->db->insert_string('captcha', $data);
        $this->db->query($query);

        // die();
        // echo $cap['image'];

        $this->load->view('auth-template', ['page' => 'login', 'cap' => $cap]);
    }

    public function check()
    {

        // First, delete old captchas
        $expiration = time() - 7200; // Two hour limit
        $this->db->where('captcha_time < ', $expiration)
            ->delete('captcha');

        // Then see if a captcha exists:
        $sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
        $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
        $query = $this->db->query($sql, $binds);
        $row = $query->row();

        if ($row->count == 0) {
            // echo 'You must submit the word that appears in the image.';
            $this->session->set_flashdata('error', 'Recaptcha tidak valid, silahkan coba lagi');
            redirect(base_url() . 'security/auth');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = ($this->input->post('remember')) ? true : false;
        // var_dump($email);
        // var_dump($password);


        // captcha pakai google

        // $token = $this->input->post('token');

        // $this->curl->create('https://www.google.com/recaptcha/api/siteverify');
        // $this->curl->post([
        //     'secret' => '6LcgC8cUAAAAAGWBMCIF5gyplngM5VAukJrsElIt',
        //     'response' => $token
        // ]);
        // $data = $this->curl->execute();

        // $captcha_data = json_decode($data);

        // // if(!$captcha_data['success'])
        // // var_dump($token);
        // // var_dump($data);
        // // var_dump($captcha_data->success);
        // if (!$captcha_data->success) {
        //     $this->session->set_flashdata('error', 'Recaptcha tidak valid, silahkan coba lagi');
        //     redirect(base_url() . 'security/auth');
        // }


        // die();
        if (!$this->ion_auth->logged_in()) {

            $ok = $this->ion_auth->login($email, $password, $remember);
            if ($ok) {
                // var_dump($ok);
                $user = $this->ion_auth->user()->row();
                //checking status verify admin
                // if (!$this->ion_auth->is_admin() && $user->active_admin == 0) {
                //     //need activate first
                //     $this->ion_auth->logout();
                //     $this->session->set_flashdata('error', 'Anda perlu diverifikasi admin. Silahkan kontak admin');
                //     // echo 'test';
                //     // redirect(base_url() . 'security/auth','location');
                //     $this->index();
                //     // die();
                // }else{

                // var_dump($user);
                // die();
                redirect(base_url() . '/dashboard');
                // }
            } else {
                $this->session->set_flashdata('error', 'Email / Password anda salah.');
                redirect(base_url() . 'security/auth');
            }
        } else {
            //already logged in
            redirect(base_url() . '/dashboard');
        }
    }

    public function logout()
    {
        $this->ion_auth->logout();
        redirect('dashboard');
    }

    public function register()
    {

        //process register
        if (!empty($username = $this->input->post('email'))) {
            $username = $this->input->post('email');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $additional_data = [
                'first_name' => $this->input->post('nama'),
                //				'tempat' => $this->input->post('tempat'),
                //				'id_kota' => $this->input->post('id_kota'),
            ];
            $group = ['2']; //member

            $ok = $this->ion_auth->register($username, $password, $email, $additional_data, $group);

            //var_dump($ok);
            if ($ok) {
                $this->session->set_flashdata('success', 'Register berhasil, silahkan cek email anda untuk verifikasi');
                $message = $this->load->view('email-verification', $ok, true);
                $send = send_email($email, 'Registration KPI User', $message);
                // var_dump($send);
            } else {
                $this->session->set_flashdata('error', 'Register Gagal, silahkan kontak admin atau coba lagi.');
            }
        }
        //get regency

        $regencies = $this->regencies_model->get_all();
        // var_dump($regencies);
        $this->load->view(
            'auth-template',
            [
                'page' => 'register',
                'data' => [
                    'regencies' => $regencies
                ]
            ]
        );
    }

    /**
     * Activate the user
     *
     * @param int         $id   The user ID
     * @param string|bool $code The activation code
     */
    public function activate($id, $code = FALSE)
    {
        $activation = FALSE;

        if ($code !== FALSE) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }

        if ($activation) {
            // redirect them to the auth page
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect("security/auth", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect("security/auth", 'refresh');
        }
    }

    public function forgot()
    {
        $this->load->view(
            'auth-template',
            [
                'page' => 'forgot',
            ]
        );
    }
}
