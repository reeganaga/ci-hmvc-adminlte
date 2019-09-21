<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_kpi_detail_model extends MY_Model
{
    
    public function __construct()
	{
        $this->table = 'tb_penilaian_kpi_detail';
        $this->primary_key = 'id';        
		parent::__construct();
    }    
    
    // public $rules = [
    //     'insert'=>[
    //         'id_periode'=>[
    //             'field'=>'id_periode',
    //             'label'=>'Periode',
    //             'rules'=>'trim|required|numeric',
                
    //         ],
    //         'id_users'=>[
    //             'field'=>'id_users',
    //             'label'=>'User',
    //             'rules'=>'trim|required'
    //         ],
    //         'id_kpi_rev'=>[
    //             'field'=>'id_kpi_rev',
    //             'label'=>'Tanggal tutup',
    //             'rules'=>'trim|required'
    //         ],
    //         'status'=>[
    //             'field'=>'status',
    //             'label'=>'Status',
    //             'rules'=>'numeric'
    //         ],
    //     ],
    //     'update'=>[
    //         'id'=>[
    //             'field'=>'id',
    //             'label'=>'Id Penilaian',
    //             'rules'=>'trim|required|numeric|is_natural_no_zero',
                
    //         ],
    //         'id_periode'=>[
    //             'field'=>'id_periode',
    //             'label'=>'Periode',
    //             'rules'=>'trim|required|numeric',
                
    //         ],
    //         'id_users'=>[
    //             'field'=>'id_users',
    //             'label'=>'User',
    //             'rules'=>'trim|required'
    //         ],
    //         'id_kpi_rev'=>[
    //             'field'=>'id_kpi_rev',
    //             'label'=>'Tanggal tutup',
    //             'rules'=>'trim|required'
    //         ],
    //         'status'=>[
    //             'field'=>'status',
    //             'label'=>'Status',
    //             'rules'=>'numeric'
    //         ],
    //     ],
    // ];
}
