<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kpi_model extends MY_Model
{
    public function __construct()
    {
        $this->table = 'tb_kpi_rev';
        $this->primary_key = 'id_kpi';
        $this->load->model(['penilaian_kpi_model', 'periode_model']);
        // $this->has_many_pivot['authors'] = array(
        //     'foreign_model'=>'User_model',
        //     'pivot_table'=>'articles_users',
        //     'local_key'=>'id',
        //     'pivot_local_key'=>'article_id',
        //     'pivot_foreign_key'=>'user_id',
        //     'foreign_key'=>'id');
        // $this->has_one['details'] = array('User_details_model','user_id','id');
        // $this->has_one['details'] = array('model'=>'User_details_model','foreign_key'=>'user_id','local_key'=>'id');

        parent::__construct();
    }

    public function get_filled_kpi($id_periode_kpi)
    {
        $kpis = $this->as_array()->get_all();

        
        if ($kpis) {
            foreach ($kpis as &$kpi) {
                //check on pengisian kpi to detect it's already filled or not

                $user = $this->ion_auth->user()->row();

                $where['id_kpi_rev'] = $kpi['id_kpi'];
                $where['id_users'] = $user->id;
                $where['id_periode_kpi'] = $id_periode_kpi;

                $pengisian_kpis = $this->penilaian_kpi_model->as_array()->get($where);
                // var_dump($pengisian_kpis);
                // var_dump($this->ion_auth->user()->row());
                // var_dump($pengisian_kpis['id_users']);
                if ($pengisian_kpis) {
                    $kpi['is_filled'] = true;
                    $kpi['penilaian'] = $pengisian_kpis;
                    $kpi['is_allowed_to_fill'] = (($pengisian_kpis['id_users'] == $user->id) || $this->ion_auth->is_admin()) ? true : false;
                    $kpi['filled_by'] =  $this->ion_auth->user($pengisian_kpis['id_users'])->row();
                } else {
                    $kpi['is_filled'] = false;
                    $kpi['penilaian'] = false;
                    $kpi['is_allowed_to_fill'] = true;
                    $kpi['filled_by'] =  false;
                }
            }
        }
        return $kpis;
    }
}
