<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian_kpi_model extends MY_Model
{
    public function __construct()
	{
        $this->table = 'tb_penilaian_kpi';
        $this->primary_key = 'id_penilaian_kpi';
		parent::__construct();
	}    
}
