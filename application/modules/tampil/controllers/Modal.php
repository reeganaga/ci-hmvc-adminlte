<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modal extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('tampil/response');
    }

    public function set_modal($modul, $controller, $function, $prm1 = null, $prm2 = null, $prm3 = null) {
    

        $this->response->dialog(array(
        
            'body' => Modules::run($modul . '/' . $controller . '/' . $function, $prm1, $prm2, $prm3)

        ));

        $this->response->send();
    }



}

/* End of file Modal.php */
/* Location: ./modules/modal/modal.php */
