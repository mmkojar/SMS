<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $data = [];
	public $error = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation','session']);
		$this->load->helper(['file','url', 'language']);
		$this->load->model('Crud_model');
		$this->load->model('Dashboard_model');
		$this->load->model('ion_auth_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
		if($this->ion_auth->in_group('user')) {
			$this->session->set_flashdata('error','You are not allowed to visit this Page');
			redirect('instock', 'refresh');
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
		
		$purchaes = $this->Dashboard_model->flterByDate('nz_purchase',$date);
		$ptotal_amt = 0;
		foreach ($purchaes as $value) {
			$ptotal_amt += $value->total_amount;
		}
		$this->data['ptotal_amt'] = $ptotal_amt;
		
		$selling = $this->Dashboard_model->flterByDate('nz_selling',$date);
		
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

	
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return [$key => $value];
	}

	public function _render_page($view, $data = NULL, $returnhtml = FALSE)//I think this makes more sense
	{

		$viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml)
		{
			return $view_html;
		}
	}
}
