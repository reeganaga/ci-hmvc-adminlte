<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kpi_detail_model extends MY_Model {

    public function __construct() {
        $this->table = 'tb_kpi_detail_rev';
        $this->primary_key = 'id_kpi_detail_rev';
        $this->return_as = 'object';
        // $this->has_many_pivot['authors'] = array(
        //     'foreign_model'=>'User_model',
        //     'pivot_table'=>'articles_users',
        //     'local_key'=>'id',
        //     'pivot_local_key'=>'article_id',
        //     'pivot_foreign_key'=>'user_id',
        //     'foreign_key'=>'id');
        $this->has_one['kpi'] = array('Kpi_model', 'id_kpi', 'id_kpi_detail_rev');
        // $this->has_one['details'] = array('model'=>'User_details_model','foreign_key'=>'user_id','local_key'=>'id');

        parent::__construct();
    }

    public $rules = [
        'insert' => [
            'id_kpi' => [
                'field' => 'id_kpi',
                'label' => 'Id Kpi',
                'rules' => 'trim|required',
            ],
            'sasaran' => [
                'field' => 'sasaran',
                'label' => 'Sasaran',
                'rules' => 'trim|required'
            ],
            'nama_indikator' => [
                'field' => 'nama_indikator',
                'label' => 'Nama indikator',
                'rules' => 'trim|required'
            ],
            'bobot' => [
                'field' => 'bobot',
                'label' => 'Nama indikator',
                'rules' => 'trim|required'
            ],
            'nilai_target' => [
                'field' => 'nilai_target',
                'label' => 'Nama indikator',
                'rules' => 'trim|required'
            ],
        ],
        'update' => [
            'id_kpi_detail_rev' => [
                'field' => 'id_kpi_detail_rev',
                'label' => 'Id Indikator',
                'rules' => 'trim|is_natural_no_zero|required'
            ],
            'sasaran' => [
                'field' => 'sasaran',
                'label' => 'Sasaran',
                'rules' => 'trim|required'
            ],
            'nama_indikator' => [
                'field' => 'nama_indikator',
                'label' => 'Nama indikator',
                'rules' => 'trim|required'
            ],
            'bobot' => [
                'field' => 'bobot',
                'label' => 'Nama indikator',
                'rules' => 'trim|required'
            ],
        ]
    ];

}
