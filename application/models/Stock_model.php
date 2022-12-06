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
        
        $this->db->select("nz_available.*,nz_items.name as item_name,nz_items.min_qty as min_qty");
        $this->db->from('nz_available');
        $this->db->join('nz_items',"nz_items.id = nz_available.item_id","left");
		if($id) {
			$this->db->where('nz_available.item_id', $id);
			$query=$this->db->get();
			return $query->row_array();
		}
		$query=$this->db->get();
		return $query->result();
	}
}
