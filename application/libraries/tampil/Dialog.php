<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Dialog {

    private $_ci;
    protected $data;

    function __construct() {
        $this->_ci = & get_instance();
    }

    public function set_id($id) {
        $this->data['id'] = $id;
    }

    public function set_body($body) {
        $this->data['body'] = $body;
    }

    public function html() {
        if (empty($this->data['id'])) {
            $this->data['id'] = 'dialog-' . mt_rand(1000000, 9999999);
        }
        return $this->_ci->load->view('dialog/dialog', $this->data, TRUE);
    }

}

/* End of file Dialog.php */
/* Location: ./application/libraries/Dialog.php */