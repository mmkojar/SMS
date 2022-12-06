<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendors extends CI_Controller {

	public $data = [];
	public $error = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['file','url', 'language']);
		$this->load->model('Crud_model');
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

		$this->data['title'] = 'Vendors';

        $this->data['vendors'] = $this->Crud_model->get('nz_vendors','');
		
		$this->_render_page('pages/Vendor/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

	public function form($id = FALSE) {

        $this->data['title'] = "Add Vendors";

		$id ?  $this->form_validation->set_rules('name','Name','trim|required')
		: $this->form_validation->set_rules('name','Name','trim|required|is_unique[nz_vendors.name]');
		// $this->form_validation->set_rules('phone','phone','required|numeric|regex_match[/^[0-9]{10}$/]');
		// $this->form_validation->set_rules('address','Address','required');	

		if ($this->form_validation->run() === TRUE)
		{						
			$additional_data = [
				'name' => trim($this->input->post('name')),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address')
			];

			if($id) {
				$this->db->select('nz_vendors.*');
				$this->db->from('nz_vendors');
				$this->db->where('nz_vendors.name', $this->input->post('name'));
				$query=$this->db->get();
				$res =  $query->row();
				if($res) {
					if($res->name !== $this->input->post('hidden_item')) {
						$this->session->set_flashdata('error', 'Vendor Name Already Exists');
						redirect("vendors/form/".$id, 'refresh');						
					}
				}

				$additional_data['updated_at'] = date('Y-m-d h:i:s');

				$this->Crud_model->update('nz_vendors',$id,$additional_data);

				$this->session->set_flashdata('success', 'Record Updated Successfully');
				redirect("vendors", 'refresh');
			}
			else {
				$additional_data['created_at'] = date('Y-m-d h:i:s');

				$this->Crud_model->insert('nz_vendors',$additional_data);

				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect("vendors/form", 'refresh');
			}
		}
		else
		{			           
			$this->data['csrf'] = $this->_get_csrf_nonce();

			if($id) {
				$this->data['title'] = "Edit Vendors";   
				$this->data['vendor'] = $this->Crud_model->get('nz_vendors',$id);
				
				// $this->_render_page('pages/Vendor/' . DIRECTORY_SEPARATOR . 'form/'.$id, $this->data);

				// redirect ('vendors/edit/'.$id, 'refresh');
			}	
			else {
				$this->data['title'] = 'Add Vendors';
				
			}			
			$this->_render_page('pages/Vendor/' . DIRECTORY_SEPARATOR . 'form', $this->data);
		}
    }

    public function delete($id) {
    	
		$del = $this->Crud_model->getByItemId('nz_purchase',$id,'vendor_id');

		if(count($del) > 0) {
			$this->session->set_flashdata('error', 'Vendors Name Already In-use Cannot be Deleted');
			redirect("vendors", 'refresh');
		}
		else {
    		$this->Crud_model->delete('nz_vendors',$id);
    		$this->session->set_flashdata('success', 'Record Deleted Successfully');
    		redirect("vendors", 'refresh');
		}
    }

    public function stock() {
    	$this->data['title'] = 'Vendors stock';
    	$this->_render_page('pages/Vendor/' . DIRECTORY_SEPARATOR . 'Stock', $this->data);
    }

	public function VendorsApi() {

		$data = $this->Crud_model->get('nz_purchase','');
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
