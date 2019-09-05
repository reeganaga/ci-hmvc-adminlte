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
