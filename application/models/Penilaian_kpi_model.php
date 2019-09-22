<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_kpi_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'tb_penilaian_kpi';
        $this->primary_key = 'id';
        $this->load->model(['kpi_detail_model', 'penilaian_kpi_detail_model']);
        $this->has_many['details'] = 'Penilaian_kpi_detail_model';
        $this->has_one['periode'] = ['Periode_model', 'id_periode_kpi', 'id_periode_kpi'];
        $this->has_one['user'] = ['Users_model', 'id', 'id_users'];
        $this->has_one['kpi'] = ['Kpi_model', 'id_kpi', 'id_kpi_rev'];
        parent::__construct();
    }

    public function get_penilaian_by_kpi($id_kpi, $id_periode_kpi, $id_user = '')
    {

        //get kpi detail 
        $data = [];
        $nilai_detail = $this->penilaian_kpi_detail_model;

        //indicator
        $kpi_details = $this->kpi_detail_model->as_array()->get_all(['id_kpi' => $id_kpi]);
        // var_dump(kpi_details);
        $allowed_keys = ['id_kpi_detail_rev', 'id_periode_kpi', 'id_users', 'id_kpi_rev', 'id_kpi_detail_rev', 'nilai_target', 'nilai_realisasi', 'skor', 'skor_akhir'];
        if ($kpi_details) {
            foreach ($kpi_details as $key => $kpi_detail) {


                //get specific penilaian by id kpi detail and periode
                if (!empty($id_user)) {
                    $where['id_users'] = $id_user;
                }
                $where['tb_penilaian_kpi_detail.id_kpi_detail_rev'] = $kpi_detail['id_kpi_detail_rev'];
                $where['id_periode_kpi'] = $id_periode_kpi;
                $where['id_kpi_rev'] = $id_kpi;

                $penilaian = $this->as_array()
                    ->join($nilai_detail->table, "{$nilai_detail->table}.id_penilaian_kpi={$this->table}.{$this->primary_key}")
                    ->where($where)
                    ->get();

                // var_dump($this->_database->last_query());
                //set array by allowed key
                foreach ($allowed_keys as $allowed_key) {
                    $item = (isset($penilaian[$allowed_key])) ? $penilaian[$allowed_key] : "";
                    $data[$kpi_detail['id_kpi_detail_rev']][$allowed_key] = $item;
                }
            }
        }
        return $data;
    }
}
