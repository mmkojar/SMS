<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $data = [];
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth','session']);
		$this->load->helper(['file','url', 'language']);
		$this->load->model('Crud_model');
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
	}

	public function index() {

		$this->data['title'] = 'Dashboard';
		if(isset($_SESSION['filter_date']) && $_SESSION['filter_date'] != '') {
			$date = $_SESSION['filter_date'];
		}
		else {
			$date = date('Y-m-d');
		}
		
		$purchaes = $this->Crud_model->flterByDate('nz_purchase',$date);
		$ptotal_amt = 0;
		foreach ($purchaes as $value) {
			$ptotal_amt += $value->total_amount;
		}
		$this->data['ptotal_amt'] = $ptotal_amt;
		
		$selling = $this->Crud_model->flterByDate('nz_selling',$date);
		
		$stotal_amt = 0;
		foreach ($selling as $value) {
			$stotal_amt += $value->total_amount;
		}
		$this->data['stotal_amt'] = $stotal_amt;

		$vendors = $this->Crud_model->get('nz_vendors','');
		$this->data['vendors'] = count($vendors);
			
		$this->load->view('Dashboard',$this->data);
	}

	public function form() {

		$date = $_POST['date'];
		$_SESSION['filter_date'] = $date;
		if($_POST['clear'] && isset($_POST['clear'])) {
			unset($_SESSION['filter_date']);
		}
		redirect('/','referesh');
	}
}
