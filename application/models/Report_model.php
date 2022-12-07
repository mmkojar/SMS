<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Report_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->lang->load('ion_auth');
	}
			
	public function get($table,$mt,$yr) {
       
		$this->db->select($table.".*,nz_items.name as item_name,nz_department.name as depart_name");
        $this->db->from($table);
        $this->db->join('nz_items',"nz_items.id = ".$table.".item_id","left");
		$this->db->join('nz_department',"nz_department.id = ".$table.".sub_item_id","left");
        if($mt) {
            $this->db->where('MONTH('.$table.'.date)',$mt);
            $this->db->where('YEAR('.$table.'.date)',$yr);
        }
        if($yr){
            $this->db->where('YEAR('.$table.'.date)',$yr);
        }
		$query=$this->db->get();
		return $query->result();
	}

}
