<?php

/**
 * Function to displaying toaster alert javascsript
 *
 * @param [error,success,warning,info] $type
 * @param [any text message] $message
 * @return void
 */
function alert($type, $message,$return=false)
{
    if (empty($message))
        return;

    switch ($type) {
        case 'error':
            $script = "toastr.error('{$message}');";
            break;

        case 'success':
            $script = "toastr.success('{$message}');";
            break;

        case 'warning':
            $script = "toastr.error('{$message}');";
            # code...
            break;

        case 'info':
            $script = "toastr.info('{$message}');";
            break;
        default:
            break;
    }
    if($return==true){
        return $script;
    }
    echo "<script>
        jQuery(document).ready(function(){
            {$script}
        })
    </script>";
}

function form_value($key, $form, $return = false)
{
    if (isset($form) && !empty($form[$key])) {
        if ($return == false) {
            echo $form[$key];
        } else {
            return $form[$key];
        }
    } else {
        if ($return == false) {
            echo set_value($key);
        } else {
            return set_value($key);
        }
    }
}

function form_checked($key, $form, $checked = true, $value = '')
{
    $temp_value = set_value($key);
    if (!empty($temp_value) && $temp_value == 1) {
        echo "checked";
    } elseif (!empty($value)) {
        if (isset($form[$key]) && $form[$key] == $value) {
            echo 'checked';
        }
    } elseif (isset($form[$key])) {
        echo ($form[$key] == 1) ? "checked" : "";
    } else {
        echo ($checked) ? "checked" : "";
    }
}

function form_selected($key, $form, $selected = true, $value = '')
{
    $temp_value = set_value($key);
    if (!empty($temp_value) && $temp_value == 1) {
        echo "selected";
    } elseif (!empty($value)) {
        if (isset($form[$key]) && $form[$key] == $value) {
            echo 'selected';
        }
    } elseif (isset($form[$key])) {
        echo ($form[$key] == 1) ? "selected" : "";
    } else {
        echo ($selected) ? "selected" : "";
    }
}

function kpi_send_email($to = '', $subject = '', $content = '')
{

    $ci = &get_instance();

    $ci->config->load('email');
    $config['mailtype'] = $ci->config->item('mailtype');
    $config['charset'] = $ci->config->item('charset');
    $config['protocol'] = $ci->config->item('protocol');
    $config['smtp_host'] = $ci->config->item('smtp_host');
    $config['smtp_user'] = $ci->config->item('smtp_user');
    $config['smtp_pass'] = $ci->config->item('smtp_pass');
    $config['smtp_port'] = $ci->config->item('smtp_port');
    $config['crlf'] = $ci->config->item('crlf');
    $config['newline'] = $ci->config->item('newline');

    // var_dump($config);
    // die();

    $config = $ci->load->library('email', $config);

    $ci->email->from('rega@softwareseni.com', 'Rega');
    $ci->email->to($to);
    // $ci->email->cc('another@another-example.com');
    $ci->email->bcc('rega.blank@gmail.com');

    $ci->email->subject($subject);
    $ci->email->message($content);

    return $ci->email->send();
}

function calculate_score($realisasi = '', $target, $bobot)
{

    if (empty($realisasi)) {
        $realisasi = 0;
    }

    if ($target == 0)
        $score = 0;
    else
        $score = ($realisasi / $target) * 100;

    $end_score = ($score * $bobot) / 100;

    $result['score'] = $score;
    $result['end_score'] = $end_score;
    return $result;
}

function kpi_format_date($data)
{
    return date('l, d M Y', strtotime($data));
}

/**
 * calculate Nilai by total score
 *
 * @param $skor
 * @return void
 */
function calculate_nilai($skor)
{
    // Nilai : 0 - 20 : E  ------  21 - 40 : D  --------- 41 - 60 : C ----------- 61 - 80 : B ----------- 81 - 100 : A
    // if (!$skor) return false;
    if ($skor < 21) {
        $nilai = "E";
    } elseif ($skor < 41) {
        $nilai = "D";
    } elseif ($skor < 61) {
        $nilai = "C";
    } elseif ($skor < 81) {
        $nilai = "B";
    } else {
        $nilai = "A";
    }
    return $nilai;
}

/**
 * @param $total grand total of skor
 */
function calculate_nilai_total($total){
    if ($total < 220) {
        $nilai = "E";
    } elseif ($total < 440) {
        $nilai = "D";
    } elseif ($total < 660) {
        $nilai = "C";
    } elseif ($total < 880) {
        $nilai = "B";
    } else {
        $nilai = "A";
    }

    return $nilai;
}

function calculate_ket_nilai($skor)
{
    if ($skor < 21) {
        echo "Sangat Kurang Baik";
    } elseif ($skor < 41) {
        echo "Kurang Baik";
    } elseif ($skor < 61) {
        echo "Cukup Baik";
    } elseif ($skor < 81) {
        echo "Baik";
    } else {
        echo "Sangat Baik";
    }
}

/**
 * display ket nilai from grand total
 * @param $total grand total of skor
 */
function calculate_ket_nilai_total($total)
{
    if ($total < 220) {
        echo "Sangat Kurang Baik";
    } elseif ($total < 440) {
        echo "Kurang Baik";
    } elseif ($total < 660) {
        echo "Cukup Baik";
    } elseif ($total < 880) {
        echo "Baik";
    } else {
        echo "Sangat Baik";
    }
}

function convert_number_to_str($number){
    if ($number==1) {
        $string="satu";
    }elseif ($number==2) {
        $string="dua";
    }elseif ($number==3) {
        $string="tiga";
    }elseif ($number==4) {
        $string="empat";
    }elseif ($number==5) {
        $string="lima";
    }elseif ($number==6) {
        $string="enam";
    }elseif ($number==7) {
        $string="tujuh";
    }elseif ($number==8) {
        $string="delapan";
    }elseif ($number==9) {
        $string="sembilan";
    }elseif ($number==10) {
        $string="sepuluh";
    }elseif ($number==11) {
        $string="sebelas";
    }elseif ($number==12) {
        $string="dua belas";
    }
    return $string;
}

function convert_date_format($cur_date, $format = 'Y-m-d')
{
    $strtotime = strtotime($cur_date);
    // var_dump($strtotime);
    $new_date = date($format, $strtotime);
    return $new_date;
}

if (!function_exists('upload_file')) {
    function upload_file($folder, $input, $old_file, $file_allow, $custom_name = '', $rand = FALSE, $thumb = FALSE)
    {
        $CI = &get_instance();
        // $config['upload_path']          = './gambar/';
        $path = realpath(FCPATH . $folder);
        // var_dump($path);die();
        $config['upload_path']          = $path;
        if ($custom_name != '') {
            $config['file_name'] = $custom_name;
        }
        // $config['allowed_types']        = 'gif|jpg|png';
        $config['allowed_types']        = $file_allow;
        $config['max_size']             = 1000;
        if ($rand == TRUE) {
            $config['encrypt_name']     = TRUE;
        }
        $config['max_size']             = 1000;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);



        // if ( ! $CI->upload->do_upload('gambar')){
        if (!$CI->upload->do_upload($input)) {
            return $CI->upload->display_errors();
            // $error = array('error' => $CI->upload->display_errors());
            // $CI->load->view('v_upload', $error);
        } else {
            /*Delete old file*/
            if ($old_file) {
                // echo $path;
                // echo realpath(FCPATH.$folder.$old_file);die();
                $deleted_path = realpath(FCPATH . $folder . $old_file);
                // var_dump($deleted_path);
                if (file_exists($deleted_path)) {
                    unlink($deleted_path);
                    //delete thumb
                    $ext = pathinfo($old_file, PATHINFO_EXTENSION);
                    $filename = explode('.', $old_file)[0] . '_thumb.' . $ext;
                    $thumb_file = realpath(FCPATH . $folder . $filename);
                    // echo FCPATH.$folder.$filename;
                    // die();
                    // var_dump($ext);
                    // var_dump($filename);
                    // var_dump($thumb_file);
                    // die();
                    if (file_exists($thumb_file)) {
                        unlink($thumb_file);
                    }
                } else {
                    /*echo "file not exist";
                echo $path.$old_file;*/
                }
            }
            //CREATE THUMBNAIL
            if ($thumb == TRUE) {
                $uploaded = $CI->upload->data();
                $filename = $CI->upload->data()['file_name'];
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $path . $filename;
                $config2['create_thumb'] = TRUE;
                $config2['maintain_ratio'] = TRUE;
                $config2['width']         = 300;
                $config2['height']       = 300;

                $CI->load->library('image_lib', $config2);

                $CI->image_lib->resize();
                // $CI->image_lib->crop();
            }
            // $path_url = explode('/assets', $CI->upload->data()['full_path']);
            // $return['file_url']=site_url().'assets'.$path_url[1];
            $return = $CI->upload->data();
            return $return;
            // $data = array('upload_data' => $CI->upload->data());
            // $CI->load->view('v_upload_sukses', $data);
        }
    }
}
