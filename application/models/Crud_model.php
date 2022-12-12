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

	public function flterByDate($table,$date) {
		$this->db->select($table.".*");
		$this->db->from($table);
		if($date !== '') {
			$this->db->where($table.'.date',$date);
		}
		$query=$this->db->get();
		return $query->result();
	}
	
	public function get($table,$id=FALSE) {
						
		if($table == 'nz_purchase' || $table == 'nz_selling') {
			$this->db->select($table.".*,nz_items.name as item_name,nz_vendors.name as vendor_name,nz_subitem.name as depart_name");
			$this->db->from($table);
			$this->db->join('nz_items',"nz_items.id =".$table.".item_id","left");
			$this->db->join('nz_vendors',"nz_vendors.id =".$table.".vendor_id","left");
			$this->db->join('nz_subitem',"nz_subitem.id =".$table.".sub_item_id","left");
		}
		else if($table == 'nz_subitem') {
			$this->db->select("nz_subitem.*,nz_items.name as item_name");
			$this->db->from("nz_subitem");
			$this->db->join('nz_items',"nz_items.id = nz_subitem.item_id","left");
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

	public function getStocks($id = FALSE) {
        
        $this->db->select("sms_available.*,nz_items.name as item_name,nz_subitem.name as depart_name,nz_items.min_qty as min_qty");
        $this->db->from('sms_available');
        $this->db->join('nz_items',"nz_items.id = sms_available.item_id","left");
		$this->db->join('nz_subitem',"nz_subitem.id = sms_available.sub_item_id","left");
		if($id) {
			$this->db->where('sms_available.item_id', $id);
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

	public function updateStockByIds($id,$sid,$data) {
		$this->db->where(['sms_available.item_id'=>$id, 'sms_available.sub_item_id'=>$sid]);
		$update = $this->db->update('sms_available',$data);
		return $update;
	}

	public function getStockAvail($id,$sid) {
		$this->db->select("sms_available.*,nz_items.name as item_name");
		$this->db->from('sms_available');
		$this->db->join('nz_items',"nz_items.id = sms_available.item_id","left");
        $this->db->where(['sms_available.item_id'=>$id, 'sms_available.sub_item_id'=>$sid]);
		/* if($x = 's') 
		{
			$this->db->where('sms_available.qty !=','0');
		} */
		$query=$this->db->get();
		return $query->result();
	}
	
	/* public function getById($table,$id) {
		if($table == 'sms_available') {
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
