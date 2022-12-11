<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense extends CI_Controller {

	public $data = [];
	public $error = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['file','url', 'language']);
		$this->load->model('Crud_model');
		$this->load->model('Report_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}
	}

	public function index() {

        $this->data['expenses'] = $this->Crud_model->get('expenses','');
		
		$this->_render_page('pages/Expense/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

    public function form($id = FALSE) {
        
		$this->form_validation->set_rules('item','Item','trim|required');

		if ($this->form_validation->run() === TRUE)
		{						
			$additional_data = [
				'item' => trim($this->input->post('item')),
				'bill_no' => trim($this->input->post('bill_no')),
				'qty' => $this->input->post('qty'),
				'rate' => $this->input->post('rate'),
				'total_amount' => $this->input->post('qty')*$this->input->post('rate'),
                'date' => $this->input->post('date'),
			];

			if($id) {
								
				$additional_data['updated_at'] = date('Y-m-d h:i:s');

				$this->Crud_model->update('expenses',$id,$additional_data);

				$this->session->set_flashdata('success', 'Record Updated Successfully');
				redirect("Expense", 'refresh');
			}
			else {
				$this->Crud_model->insert('expenses',$additional_data);

				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect("Expense", 'refresh');
			}
		}
		else
		{			           
			$this->data['csrf'] = $this->_get_csrf_nonce();

			if($id) {
				$this->data['title'] = "Edit Expense";   
				$this->data['expense'] = $this->Crud_model->get('expenses',$id);

			}	
			else {
				$this->data['title'] = 'Add Expense';
				
			}			
			$this->_render_page('pages/Expense/' . DIRECTORY_SEPARATOR . 'form', $this->data);
		}
    }
    
    public function delete($id) {
    	
        $this->Crud_model->delete('expenses',$id);
        $this->session->set_flashdata('success', 'Record Deleted Successfully');
        redirect("Expense", 'refresh');
		
    }

    public function api() {
        $sell = $this->Report_model->get('nz_selling',$_GET['mt'],$_GET['yr']);
        $expense = $this->Report_model->get('expenses',$_GET['mt'],$_GET['yr']);

        print_r(json_encode(['sell'=>$sell,'expense'=>$expense]));
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
