<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {

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

		$this->data['title'] = 'Items';            

		$this->data['items'] = $this->Crud_model->get('nz_items','');
		
		$this->_render_page('pages/Items/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

	public function form($id = FALSE) {

		$id ? $this->form_validation->set_rules('name','Name','trim|required')
		:  $this->form_validation->set_rules('name','Name','trim|required|is_unique[nz_items.name]');

        // $this->form_validation->set_rules('min_qty','Min Quantity','trim|required');
		$inputname = trim($this->input->post('name'));
		if ($this->form_validation->run() === TRUE)
		{						
			$additional_data = [
				'name' => $inputname,
				// 'min_qty' => trim($this->input->post('min_qty')),
			];

			if($id) {
				
				// $query = $this->db->query('SELECT * FROM `nz_items` WHERE nz_items.name='.$inputname);
				$this->db->select('nz_items.*');
				$this->db->from('nz_items');
				$this->db->where('nz_items.name', $this->input->post('name'));
				$query=$this->db->get();
				$res =  $query->row_array();
				if($res) {
					if($res['name'] !== $this->input->post('hidden_item')) {
						$this->session->set_flashdata('error', 'Item Name Already Exists');
						redirect("items/form/".$id, 'refresh');						
					}
				}
				$additional_data['updated_at'] = date('Y-m-d h:i:s');

				$this->Crud_model->update('nz_items',$id,$additional_data);

				$this->session->set_flashdata('success', 'Record Updated Successfully');
				redirect("Items", 'refresh');
			}
			else {
				$additional_data['created_at'] = date('Y-m-d h:i:s');

				$this->Crud_model->insert('nz_items',$additional_data);

				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect("Items", 'refresh');
			}
		}
		else
		{			           
			$this->data['csrf'] = $this->_get_csrf_nonce();

			if($id) {
				$this->data['title'] = "Edit Items";   
				$this->data['items'] = $this->Crud_model->get('nz_items',$id);

			}	
			else {
				$this->data['title'] = 'Add Items';
				
			}			
			$this->_render_page('pages/Items/' . DIRECTORY_SEPARATOR . 'form', $this->data);
		}
    }

    public function delete($id) {
    	
		$del = $this->Crud_model->getByItemId('nz_purchase',$id,'item_id');

		if(count($del) > 0) {
			$this->session->set_flashdata('error', 'Items Already In-use Cannot be Deleted');
			redirect("Items", 'refresh');
		}
		else {
			$this->Crud_model->delete('nz_items',$id);
			$this->session->set_flashdata('success', 'Record Deleted Successfully');
			redirect("Items", 'refresh');
		}

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
