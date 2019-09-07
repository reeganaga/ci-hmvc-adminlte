<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Regencies_model extends MY_Model
{
    public function __construct()
	{
        $this->table = 'regencies';
        $this->primary_key = 'id';
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
}
