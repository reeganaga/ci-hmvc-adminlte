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


function form_value($key,$form){
    if(isset($form) && !empty($form[$key])){
        echo $form[$key];
    }else{
        set_value($key);
    }
}