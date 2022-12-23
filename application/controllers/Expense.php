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

		$this->db->select("expenses.*,nz_vendors.name as vendor_name");
		$this->db->from('expenses');
		$this->db->join('nz_vendors',"nz_vendors.id = expenses.vendor_id","left");
		$query=$this->db->get();
		
        $this->data['expenses'] = $query->result();
		
		$this->_render_page('pages/Expense/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

    public function form($id = FALSE) {
        
		
		$this->form_validation->set_rules('vendor_id','Vendor','trim|required');

		if ($this->form_validation->run() === TRUE)
		{
			$additional_data = [
				'vendor_id' => trim($this->input->post('vendor_id')),
				'bill_no' => trim($this->input->post('bill_no')),
				// 'item' => $this->input->post('item'),
				// 'qty' => $this->input->post('qty'),
				'rate' => $this->input->post('rate'),
				'total_amount' => $_POST['rate'],
				'gst' => $_POST['gst_perc'],
				'final_total' => ($_POST['gst_perc']/100*$_POST['rate'])+$_POST['rate'],
				'date' => $this->input->post('date'),
			];

			if($id) {
				
				$additional_data['updated_at'] = date('Y-m-d h:i:s');
				$this->Crud_model->update('expenses',$id,$additional_data);
				$this->session->set_flashdata('success', 'Record Updated Successfully');
				
			}
			else {
				$additional_data['created_at'] = date('Y-m-d h:i:s');
				$this->Crud_model->insert('expenses',$additional_data);
				/* $_POST['item'] = (explode(',',$_POST['item'][0]));
				$_POST['qty'] = (explode(',',$_POST['qty'][0]));
				$_POST['rate'] = (explode(',',$_POST['rate'][0]));

				for($i = 0; $i < count($_POST['item']); $i++) {
					$total = $_POST['qty'][$i]*$_POST['rate'][$i];
					$insert_data = [
						'vendor_id' => $_POST['vendor_id'][0],
						'bill_no' => $_POST['bill_no'][0],
						'item' => $_POST['item'][$i],
						'qty' => $_POST['qty'][$i],
						'rate' => $_POST['rate'][$i],
						'total_amount' => $total,
						'date' => $_POST['date'][0],
						'gst' => $_POST['gst_perc'][0],
						'final_total' => ($_POST['gst_perc'][0]/100*$total)+$total,
						'created_at' => date('Y-m-d h:i:s')
					];
					$this->Crud_model->insert('expenses',$insert_data);
                } */

				$this->session->set_flashdata('success', 'Record Added Successfully');
			}
			redirect("Expense", 'refresh');
		}
		else
		{
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['vendors'] = $this->Crud_model->get('nz_vendors','');
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
