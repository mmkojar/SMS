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
		
		if($table == 'nz_purchase' || $table == 'nz_selling') {
			$this->db->select($table.".*,nz_items.name as item_name,nz_subitem.name as depart_name,nz_vendors.name as vendor_name");
			$this->db->from($table);
			$this->db->join('nz_items',"nz_items.id = ".$table.".item_id","left");
			$this->db->join('nz_vendors',"nz_vendors.id =".$table.".vendor_id","left");
			$this->db->join('nz_subitem',"nz_subitem.id = ".$table.".sub_item_id","left");
		}
		else {
			$this->db->select($table.'.*');
			$this->db->from($table);
		}
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
