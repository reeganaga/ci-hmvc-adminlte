<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_kpi_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'tb_penilaian_kpi';
        $this->primary_key = 'id_penilaian_kpi';
        $this->load->model('kpi_detail_model');
        parent::__construct();
    }

    public function get_penilaian_by_kpi($id_kpi,$id_periode_kpi)
    {

        //get kpi detail 
        $data = [];
        $kpi_details = $this->kpi_detail_model->as_array()->get_all(['id_kpi' => $id_kpi]);
        $allowed_keys = ['id_kpi_detail_rev', 'id_periode_kpi', 'id_users', 'id_kpi_rev', 'id_kpi_detail_rev', 'nilai_target', 'nilai_realisasi', 'skor', 'skor_akhir'];
        if ($kpi_details) {
            foreach ($kpi_details as $key => $kpi_detail) {


                //get specific penilaian by id kpi detail and periode
                $penilaian = $this->as_array()->get([
                    'id_kpi_detail_rev' => $kpi_detail['id_kpi_detail_rev'],
                    'id_periode_kpi'=>$id_periode_kpi
                ]);

                //set array by allowed key
                foreach ($allowed_keys as $allowed_key) {
                    $item = (isset($penilaian[$allowed_key])) ? $penilaian[$allowed_key] :"";
                    $data[$kpi_detail['id_kpi_detail_rev']][$allowed_key]= $item;
                }

            }
        }
        return $data;
    }
}
