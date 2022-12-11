<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Listing extends CI_Controller {

	public $data = [];
	public $error = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth']);
		$this->load->model(['Crud_model']);
		
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
	}

	public function index() {

        $this->data['purchases'] = $this->Crud_model->get('nz_purchase','');
        $this->data['sellings'] = $this->Crud_model->get('nz_selling','');
        // $this->data['instocks'] = $this->Crud_model->getStocks();
		
		$this->load->view('pages/Stock/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

	public function api() {
		$pur = $this->Crud_model->get('nz_purchase','');
		$sal = $this->Crud_model->get('nz_selling','');

		print_r(json_encode(['pur'=>$pur,'sale'=>$sal]));
	}
}
