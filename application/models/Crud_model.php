<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crud_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->lang->load('ion_auth');
	}

	public function get($table,$id=FALSE) {
						
		if($table == 'nz_purchase') {
			$this->db->select($table.".*,nz_vendors.name as vendor_name,nz_department.name as depart_name,nz_items.name as item_name");
			$this->db->from($table);
			$this->db->join('nz_items',"nz_items.id =".$table.".item_id","left");
			$this->db->join('nz_vendors',"nz_vendors.id =".$table.".vendor_id","left");
			$this->db->join('nz_department',"nz_department.id =".$table.".dpt_id","left");
		}
		else {
			$this->db->select($table.'.*');
			$this->db->from($table);
		}
		if($id) {
			$this->db->where($table.'.id',$id);
			$query=$this->db->get();
			return $query->row_array();
		}
		$query=$this->db->get();
		return $query->result();
	}

	public function insert($table,$data) {

		$this->db->insert($table, $data);
		$id = $this->db->insert_id();
		return $id;
	}

	public function update($table,$id,$data) {
		$this->db->where($table.'.id',$id);
		$update = $this->db->update($table,$data);
		return $update;
	}

	public function updateById($table,$id,$data) {
		$this->db->where($table.'.item_id',$id);
		$update = $this->db->update($table,$data);
		return $update;
	}

	public function delete($table,$id) {
		$this->db->where('id',$id);
		$this->db->delete($table);
		return true;
	}

	public function deleteById($table,$id) {
		$this->db->where('item_id',$id);
		$this->db->delete($table);
		return true;
	}

	public function getByItemId($table,$id,$tid) {
		
		$this->db->select($table.".*");
		$this->db->from($table);	
		$this->db->where($table.'.'.$tid,$id);
		$query=$this->db->get();
		return $query->result();
	}
	
	/* public function getById($table,$id) {
		if($table == 'nz_available') {
			$this->db->select($table.".*,nz_purchase.qty tqty");
			$this->db->from($table);
			$this->db->join('nz_purchase',"nz_purchase.id =".$table.".item_id","right");			
		}
		else {
			$this->db->select($table.".*");
			$this->db->from($table);
		}		
		$this->db->where($table.'.item_id',$id);
		$query=$this->db->get();
		return $query->result();
	} */

}
