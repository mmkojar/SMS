<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard_model extends CI_Model
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

}
