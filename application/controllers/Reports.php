<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public $data = [];
	public $error = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth']);
		$this->load->model('Report_model');
		
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
	}

	public function index() {

		$this->load->view('pages/Reports/index');
	}
    
    public function purchaseApi() {

		$data = $this->Report_model->get('nz_purchase',$_GET['mt'],$_GET['yr']);
		print_r(json_encode($data));
    }
    
    public function sellingApi() {

		$data = $this->Report_model->get('nz_selling',$_GET['mt'],$_GET['yr']);
		print_r(json_encode($data));
    }
}
