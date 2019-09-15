<?php

/**
 * Function to displaying toaster alert javascsript
 *
 * @param [error,success,warning,info] $type
 * @param [any text message] $message
 * @return void
 */
function alert($type, $message)
{
    if (empty($message)) return;

    switch ($type) {
        case 'error':
            $script = "toastr.error('{$message}')";
            break;

        case 'success':
            $script = "toastr.success('{$message}')";
            break;

        case 'error':
            $script = "toastr.error('{$message}')";
            # code...
            break;

        case 'info':
            $script = "toastr.info('{$message}')";
            break;
        default:
            break;
    }
    echo "<script>
        jQuery(document).ready(function(){
            {$script}
        })
    </script>";
}


function form_value($key, $form)
{
    if (isset($form) && !empty($form[$key])) {
        echo $form[$key];
    } else {
        echo set_value($key);
    }
}

function form_checked($key, $form, $checked=true)
{
    $temp_value = set_value($key);
    if (!empty($temp_value) && $temp_value==1) {
        echo "checked";
    }elseif(isset($form[$key])) {
        echo ($form[$key] == 1) ? "checked" : "";
    }else{
        echo ($checked)?"checked":"";
    }
}

function send_email($to='',$subject='',$content=''){

    $ci =& get_instance();

    $ci->config->load('email');
    $config['mailtype']= $ci->config->item('mailtype');
    $config['charset']= $ci->config->item('charset');
    $config['protocol']= $ci->config->item('protocol');
    $config['smtp_host']= $ci->config->item('smtp_host');
    $config['smtp_user']= $ci->config->item('smtp_user');
    $config['smtp_pass']= $ci->config->item('smtp_pass');
    $config['smtp_port']= $ci->config->item('smtp_port');
    $config['crlf']= $ci->config->item('crlf');
    $config['newline']    = $ci->config->item('newline');

    // var_dump($config);
    // die();

    $config = 
    $ci->load->library('email',$config);

    $ci->email->from('rega@softwareseni.com', 'Rega');
    $ci->email->to($to);
    // $ci->email->cc('another@another-example.com');
    $ci->email->bcc('rega.blank@gmail.com');
    
    $ci->email->subject($subject);
    $ci->email->message($content);
    
    return $ci->email->send();    
}

function calculate_score($realisasi,$target,$bobot){
    $score = ($realisasi/$target)*100;
    $end_score = ($score * $bobot)/100;
    
    $result['score'] = $score;
    $result['end_score'] = $end_score;
    return $result;
}