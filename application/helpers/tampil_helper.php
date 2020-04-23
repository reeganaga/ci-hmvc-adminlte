<?php

defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('modal')) {

    function modal($modul, $function, $prm1 = null, $prm2 = null, $prm3 = null) {
        return site_url('tampil/modal/set_modal/' . $modul . '/' . $function . '/' . $prm1 . '/' . $prm2 . '/' . $prm3);
    }

}


