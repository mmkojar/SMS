<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

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

		$this->data['title'] = 'Purchases';

        $this->data['purchases'] = $this->Crud_model->get('nz_purchase','');
		
		$this->_render_page('pages/Stock/purchase/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

	public function add() {

        $this->data['title'] = "Add Purchase";

        $vendors = $this->Crud_model->get('nz_vendors','');
    	$output = '';
    	foreach($vendors as $row) {
    		 $output .= '<optgroup><option value="'.$row->id.'">'.trim($row->name).'</option></optgroup>';
    	}
    	$this->data['vendors'] = $output;

    	$departs = $this->Crud_model->get('nz_department','');
    	$output1 = '';
    	foreach($departs as $row) {
    		 $output1 .= '<optgroup><option value="'.$row->id.'">'.trim($row->name).'</option></optgroup>';
    	}
    	$this->data['departs'] = $output1;

    	$items = $this->Crud_model->get('nz_items','');
    	$output2 = '';
    	foreach($items as $row) {
    		 $output2 .= '<optgroup><option value="'.$row->id.'">'.trim($row->name).'</option></optgroup>';
    	}
    	$this->data['items'] = $output2;

        $this->data['csrf'] = $this->_get_csrf_nonce();

        $this->_render_page('pages/Stock/purchase/' . DIRECTORY_SEPARATOR . 'add', $this->data);
    }

    public function insert() {
    
    	unset($_POST['submit']);

    	if(!empty($_POST["vendor_id"])) {
    		for($i = 0; $i < count($_POST["vendor_id"]); $i++)
	    	{    		    
	    		if(!empty($_POST["vendor_id"][$i])) {

		    		$additional_data = [
		    			'vendor_id' => $_POST["vendor_id"][$i],
		    			'dpt_id' => $_POST["dpt_id"][$i] ? $_POST["dpt_id"][$i] : '0',
		    			'item_id' => $_POST["item_name"][$i],
		    			'unit' => $_POST["unit"][$i],
		    			'qty' => $_POST["qty"][$i],
		    			'rate' => $_POST["rate"][$i],
		    			'total_amount' => ($_POST["qty"][$i]*$_POST["rate"][$i]),
		    			'date' => $_POST["date"][$i],
		    			'created_at' => date('Y-m-d h:i:s'),
		    		];
										
		    		$this->Crud_model->insert('nz_purchase',$additional_data);
					$getavail = $this->Crud_model->getByItemId('nz_available',$_POST["item_name"][$i],'item_id');

					$getpurchase = $this->Crud_model->getByItemId('nz_purchase',$_POST["item_name"][$i],'item_id');
					
					$sum_qty = 0;
					$sum_totamont = 0;
					foreach ($getpurchase as $value) {
						$sum_qty += $value->qty;
						$sum_totamont += $value->total_amount;
					}
					if($getavail) {
						$this->Crud_model->updateById('nz_available',$_POST["item_name"][$i],[
			    			'qty' => $getavail[0]->qty + $_POST["qty"][$i],
							'rate' => number_format(($sum_totamont / $sum_qty),2),
		    				'updated_at' => date('Y-m-d h:i:s'),
		    			]);
					}
					else {
						$this->Crud_model->insert('nz_available',[
		    				'item_id' => $_POST["item_name"][$i],
		    				'unit' => $_POST["unit"][$i],
			    			'qty' => $_POST["qty"][$i],
			    			'rate' => (($_POST["qty"][$i] * $_POST["rate"][$i]) / $_POST["qty"][$i]),
			    			'date' => $_POST["date"][$i],
		    				'created_at' => date('Y-m-d h:i:s'),
		    			]);
					}
				}
	    	}
    	}

    	print_r(json_encode(['status'=>'success','msg'=>'Record Added Successfully']));
    }

    public function delete($id, $itemId) {
    			
		$checkSelling = $this->Crud_model->getByItemId('nz_selling',$itemId,'item_id');
		
		if(count($checkSelling) > 0) {
			$this->session->set_flashdata('error', 'Items Already sold Cannot be Deleted');
			redirect("purchase", 'refresh');
		}
		else {
			$this->Crud_model->delete('nz_purchase',$id);
			$this->Crud_model->deleteById('nz_available',$itemId);
			$this->session->set_flashdata('success', 'Record Deleted Successfully');
			redirect("purchase", 'refresh');
		}
    	
    }

    public function edit($id) {
                    
        $this->form_validation->set_rules('rate','Purchase Rate','required');

		if ($this->form_validation->run() === TRUE)
		{
			 $additional_data = [
				'vendor_id' => $this->input->post("vendor_id"),
				'dpt_id' => $this->input->post("dpt_id") ? $this->input->post("dpt_id") : '0',
				// 'item_id' => $this->input->post("item_name"),
				'unit' => $this->input->post("unit"),
				'qty' => $this->input->post("qty"),
				'rate' => $this->input->post("rate"),
				'total_amount' => $this->input->post("qty") * $this->input->post("rate"),
				'date' => $this->input->post("date"),
				'updated_at' => date('Y-m-d h:i:s'),
			];
			$done = $this->Crud_model->update('nz_purchase',$id,$additional_data);	
			if($done) {
					$getpurchase = $this->Crud_model->getByItemId('nz_purchase',$_POST["item_name"],'item_id');
					
					$sum_qty = 0;
					$sum_totamont = 0;
					foreach ($getpurchase as $value) {
						$sum_qty += $value->qty;
						$sum_totamont += $value->total_amount;
					}
					$this->Crud_model->updateById('nz_available',$this->input->post("item_name"),[
	    				'unit' => $this->input->post("unit"),
						'rate' => number_format(($sum_totamont / $sum_qty),2),
	    				'updated_at' => date('Y-m-d h:i:s'),
	    			]);
			}
			$this->session->set_flashdata('success', 'Record Updated Successfully');
			redirect("purchase", 'refresh');
		}
		else {

			$this->data['title'] = "Edit Purchase";

			// $sellingCount = $this->Crud_model->getById('nz_selling',$id);
			// $this->data['qtyreadlonly'] =  count($sellingCount) > 0 ? 'readonly' : '';
			$this->data['items'] = $this->Crud_model->get('nz_items','');
			$this->data['vendors'] = $this->Crud_model->get('nz_vendors','');
			$this->data['departs'] = $this->Crud_model->get('nz_department','');
        	$this->data['purchase'] = $this->Crud_model->get('nz_purchase',$id);

        	$this->data['csrf'] = $this->_get_csrf_nonce();

			$this->_render_page('pages/Stock/purchase/' . DIRECTORY_SEPARATOR . 'edit', $this->data);
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
