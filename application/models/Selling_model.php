<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selling_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->lang->load('ion_auth');
	}

    public function get($id=FALSE) {						
		
        $this->db->select("nz_selling.*,nz_department.name as depart_name,nz_items.name as item_name");
        $this->db->from('nz_selling');
        $this->db->join('nz_items',"nz_items.id = nz_selling.item_id","left");
        $this->db->join('nz_department',"nz_department.id = nz_selling.sub_item_id","left");
		if($id) {
			$this->db->where('nz_selling.id',$id);
			$query=$this->db->get();
			return $query->row_array();
		}
		$query=$this->db->get();
		return $query->result();
	}

   /*  public function getItemsByQty() {
		$this->db->select("sms_available.*,nz_items.name as item_name");
		$this->db->from('sms_available');
		$this->db->join('nz_items',"nz_items.id = sms_available.item_id","left");
		$this->db->where('sms_available.qty !=','0');
		$query=$this->db->get();
		return $query->result();
	} */
    
}
