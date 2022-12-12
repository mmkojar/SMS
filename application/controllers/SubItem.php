<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubItem extends CI_Controller {

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

		$this->data['title'] = 'Sub-Items';
		$this->data['items'] = $this->Crud_model->get('nz_items');
		$this->data['csrf'] = $this->_get_csrf_nonce();
		$this->data['subitems'] = $this->Crud_model->get('nz_subitem','');
		
		$this->_render_page('pages/SubItem/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

	public function form($id = FALSE) {

        $this->data['title'] = "Add Sub-Items";

		$this->form_validation->set_rules('item_id','Item','trim|required');
		
		$id ? $this->form_validation->set_rules('name','Name','trim|required')
		:  $this->form_validation->set_rules('name','Name','trim|required|is_unique[nz_subitem.name]');

		if ($this->form_validation->run() === TRUE)
		{									
			if($id) {
				$additional_data = [
					'item_id' => trim($this->input->post('item_id')),
					'name' => trim($this->input->post('name')),
				];
				/* $this->db->select('nz_subitem.*');
				$this->db->from('nz_subitem');
				$this->db->where(['nz_subitem.name'=> $this->input->post('name'),'nz_subitem.item_id'=>$this->input->post('item_id')]);
				$query=$this->db->get();
				$res =  $query->row();
				if($res) {
					if($res->name !== $this->input->post('hidden_item')) {
						$this->session->set_flashdata('error', 'SubItem Name Already Exists with same Item');
						redirect("SubItem/form/".$id, 'refresh');						
					}
				} */				
				$additional_data['updated_at'] = date('Y-m-d h:i:s');

				$this->Crud_model->update('nz_subitem',$id,$additional_data);

				$this->session->set_flashdata('success', 'Record Updated Successfully');
				redirect("SubItem", 'refresh');
			}
			else {

				$collection = array_filter(explode(',', $this->input->post('name')),'strlen');
				for($i = 0; $i < count($collection); $i++) {
					$insert_data = [
						'item_id' => trim($this->input->post('item_id')),
						'name' => $collection[$i],
						'created_at' => date('Y-m-d h:i:s')
					];
					$this->Crud_model->insert('nz_subitem',$insert_data);
                }

				$this->session->set_flashdata('success', 'Record Added Successfully');
				redirect("SubItem", 'refresh');
			}
		}
		else
		{			           
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['items'] = $this->Crud_model->get('nz_items');
			if($id) {
				$this->data['title'] = "Edit Sub-Items";
				$this->data['subitem'] = $this->Crud_model->get('nz_subitem',$id);
				$this->_render_page('pages/SubItem/' . DIRECTORY_SEPARATOR . 'form', $this->data);

			}	
			else {
				$this->data['subitems'] = $this->Crud_model->get('nz_subitem','');
				$this->_render_page('pages/SubItem/' . DIRECTORY_SEPARATOR . 'index', $this->data);
				
			}			
			
		}
    }

    public function delete($id) {
    	
		$del = $this->Crud_model->getByItemId('nz_purchase',$id,'sub_item_id');
		
		if(count($del) > 0) {
			$this->session->set_flashdata('error', 'SubItem Already In-use Cannot be Deleted');
			redirect("SubItem", 'refresh');
		}
		else {
			$this->Crud_model->delete('nz_subitem',$id);
			$this->session->set_flashdata('success', 'Record Deleted Successfully');
			redirect("SubItem", 'refresh');
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
