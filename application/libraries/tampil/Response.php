<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

class Response {

    private $_ci;
    protected $data;

    function __construct() {
        $this->_ci = & get_instance();
    }

    public function script($script) {
        $this->data['scripts'][] = $script;
    }

    public function reload_page() {
        $this->script("location.reload(true);");
    }

    public function dialog($data) {
        $this->_ci->load->library('tampil/dialog');

        $dialog_id = (empty($data['id'])) ?
                'dialog-' . mt_rand(1000000, 9999999) :
                $data['id'];
        $this->_ci->dialog->set_id($dialog_id);

    

        if (!empty($data['body'])) {
            $this->_ci->dialog->set_body($data['body']);
        }

        $html = $this->_ci->dialog->html();
        $json_html = json_encode($html);

        $code = <<< JS
$('body').append({$json_html});
$('#{$dialog_id}')
    .find('form[rel="async"]').data('caller', $(this)).end()
    .modal({
            backdrop: 'static',
            keyboard: false
        }).on('hidden.bs.modal', function(e) {
        setTimeout(function() {
            $(e.target).remove();
        }, 1);
    });
JS;
        $this->script($code);
    }

    public function send($return = FALSE) {
        if (!empty($this->data)) {
            if ($this->_ci->input->is_ajax_request()) {
                $json_data = json_encode($this->data);
                if ($return) {
                    return $json_data;
                } else {
                    echo $json_data;
                    exit;
                }
            }
        }
    }

}

/* End of file Response.php */
/* Location: ./application/libraries/Response.php */