<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{
    
    public function __construct()
	{
        $this->table = 'users';
        $this->primary_key = 'id';        

        $this->has_many['groups'] = array('foreign_model'=>'Users_group_model','foreign_table'=>'Users_group','foreign_key'=>'user_id','local_key'=>'id');
        $this->has_one['regency'] = array('local_key'=>'id_kota', 'foreign_key'=>'id', 'foreign_model'=>'Regencies_model');
		parent::__construct();
    }    
    
    /* public $rules = [
        'insert'=>[
            'periode'=>[
                'field'=>'periode',
                'label'=>'Periode',
                'rules'=>'trim|required|numeric',
                
            ],
            'tgl_buka'=>[
                'field'=>'tgl_buka',
                'label'=>'Tanggal Buka',
                'rules'=>'trim|required'
            ],
            'tgl_tutup'=>[
                'field'=>'tgl_tutup',
                'label'=>'Tanggal tutup',
                'rules'=>'trim|required'
            ],
            'k_aktif'=>[
                'field'=>'k_aktif',
                'label'=>'Aktif',
                'rules'=>'numeric'
            ],
        ],
        'update'=>[
            'id_periode_kpi'=>[
                'field'=>'id_periode_kpi',
                'label'=>'Id Periode KPI',
                'rules'=>'trim|is_natural_no_zero|required'
            ],
            'periode'=>[
                'field'=>'periode',
                'label'=>'Periode',
                'rules'=>'trim|required|numeric',
            ],
            'tgl_buka'=>[
                'field'=>'tgl_buka',
                'label'=>'Tanggal Buka',
                'rules'=>'trim|required'
            ],
            'tgl_tutup'=>[
                'field'=>'tgl_tutup',
                'label'=>'Tanggal tutup',
                'rules'=>'trim|required'
            ],
            'k_aktif'=>[
                'field'=>'k_aktif',
                'label'=>'Aktif',
                'rules'=>'numeric'
            ],
        ]
    ]; */
}
