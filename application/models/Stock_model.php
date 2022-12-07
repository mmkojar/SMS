<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->lang->load('ion_auth');
	}

	public function get($id = FALSE) {
        
        $this->db->select("sms_available.*,nz_items.name as item_name,nz_department.name as depart_name,nz_items.min_qty as min_qty");
        $this->db->from('sms_available');
        $this->db->join('nz_items',"nz_items.id = sms_available.item_id","left");
		$this->db->join('nz_department',"nz_department.id = sms_available.sub_item_id","left");
		if($id) {
			$this->db->where('sms_available.item_id', $id);
			$query=$this->db->get();
			return $query->row_array();
		}
		$query=$this->db->get();
		return $query->result();
	}

}
