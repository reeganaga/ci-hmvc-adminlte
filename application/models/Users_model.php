<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{

    public function __construct()
    {
        $this->table = 'users';
        $this->primary_key = 'id';

        $this->has_many['groups'] = array('foreign_model' => 'Users_group_model', 'foreign_table' => 'Users_group', 'foreign_key' => 'user_id', 'local_key' => 'id');
        $this->has_one['regency'] = array('local_key' => 'id_kota', 'foreign_key' => 'id', 'foreign_model' => 'Regencies_model');
        $this->has_one['province'] = array('local_key' => 'id_provinsi', 'foreign_key' => 'id', 'foreign_model' => 'Provinces_model');
        $this->pendidikan = ['sd', 'smp', 'sma', 'd3', 's1', 's2/s3'];
        $this->jenis_usaha = ['agribisnis', 'jasa', 'kuliner', 'fashion', 'lainnya'];
        $this->kelompok_usaha = ['umkm', 'bumdes'];
        parent::__construct();
    }

    public $rules = [
        'update' => [
            'first_name' => [
                'field' => 'first_name',
                'label' => 'first_name',
                'rules' => 'trim|required',
            ],
            'no_ktp' => [
                'field' => 'no_ktp',
                'label' => 'no_ktp',
                'rules' => 'trim|required|numeric',
            ],
            'tgl_lahir' => [
                'field' => 'tgl_lahir',
                'label' => 'tgl_lahir',
                'rules' => 'trim|required',
            ],
            'pendidikan' => [
                'field' => 'pendidikan',
                'label' => 'pendidikan',
                'rules' => 'trim|required',
            ],
            'jenis_usaha' => [
                'field' => 'jenis_usaha',
                'label' => 'jenis_usaha',
                'rules' => 'trim|required',
            ],
            'deskripsi_usaha' => [
                'field' => 'deskripsi_usaha',
                'label' => 'deskripsi_usaha',
                'rules' => 'trim|required',
            ],
            'omset' => [
                'field' => 'omset',
                'label' => 'omset',
                'rules' => 'trim|required',
            ],
            'tempat' => [
                'field' => 'tempat',
                'label' => 'tempat',
                'rules' => 'trim|required',
            ],
            'kelompok_usaha' => [
                'field' => 'kelompok_usaha',
                'label' => 'kelompok_usaha',
                'rules' => 'trim|required',
            ],
            'id_provinsi' => [
                'field' => 'id_provinsi',
                'label' => 'id_provinsi',
                'rules' => 'trim|required|numeric',
            ],
            'id_kota' => [
                'field' => 'id_kota',
                'label' => 'id_kota',
                'rules' => 'trim|required|numeric',
            ],

        ],
        'insert' => [
            'first_name' => [
                'field' => 'first_name',
                'label' => 'first_name',
                'rules' => 'trim|required',
            ],
            'no_ktp' => [
                'field' => 'no_ktp',
                'label' => 'no_ktp',
                'rules' => 'trim|required|numeric',
            ],
            'tgl_lahir' => [
                'field' => 'tgl_lahir',
                'label' => 'tgl_lahir',
                'rules' => 'trim|required',
            ],
            'pendidikan' => [
                'field' => 'pendidikan',
                'label' => 'pendidikan',
                'rules' => 'trim|required',
            ],
            'jenis_usaha' => [
                'field' => 'jenis_usaha',
                'label' => 'jenis_usaha',
                'rules' => 'trim|required',
            ],
            'deskripsi_usaha' => [
                'field' => 'deskripsi_usaha',
                'label' => 'deskripsi_usaha',
                'rules' => 'trim|required',
            ],
            'omset' => [
                'field' => 'omset',
                'label' => 'omset',
                'rules' => 'trim|required',
            ],
            'tempat' => [
                'field' => 'tempat',
                'label' => 'tempat',
                'rules' => 'trim|required',
            ],
            'kelompok_usaha' => [
                'field' => 'kelompok_usaha',
                'label' => 'kelompok_usaha',
                'rules' => 'trim|required',
            ],
            'id_provinsi' => [
                'field' => 'id_provinsi',
                'label' => 'id_provinsi',
                'rules' => 'trim|required|numeric',
            ],
            'id_kota' => [
                'field' => 'id_kota',
                'label' => 'id_kota',
                'rules' => 'trim|required|numeric',
            ],
        ]
    ];
}
