<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

	public $data = [];
	public $error = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['file','url', 'language']);
		$this->load->model('Report_model');
		$this->load->model('ion_auth_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
	}

	public function purchase() {

		$this->data['title'] = 'Purchase Reports';
		
        $this->_render_page('pages/Reports/purchase' , $this->data);
	}
    
    public function purchaseApi() {

		$data = $this->Report_model->get('nz_purchase',$_GET['mt'],$_GET['yr']);
		print_r(json_encode($data));
    }

	public function selling() {

		$this->data['title'] = 'Selling Reports';
		
        $this->_render_page('pages/Reports/selling' , $this->data);
	}
    
    public function sellingApi() {

		$data = $this->Report_model->get('nz_selling',$_GET['mt'],$_GET['yr']);
		print_r(json_encode($data));
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
