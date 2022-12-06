<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Selling extends CI_Controller {

	public $data = [];
	public $error = '';
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['file','url', 'language']);
		$this->load->model('Crud_model');
		$this->load->model('Selling_model');
		$this->load->model('Stock_model');
		$this->load->model('ion_auth_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}		
	}

	public function index() {

		if($this->ion_auth->in_group('user')) {

			$this->session->set_flashdata('error','You are not allowed to visit this Page');
			redirect('instock', 'refresh');
		}
		$this->data['title'] = 'Selling';

        $this->data['sellings'] = $this->Selling_model->get('');
        
		$this->_render_page('pages/Stock/selling/' . DIRECTORY_SEPARATOR . 'index', $this->data);
	}

	public function add() {

        $this->data['title'] = "Add Selling";

		$items = $this->Selling_model->getItemsByQty();
    	$output = '';
    	foreach($items as $row) {
    		$output .= '<optgroup><option value="'.$row->item_id.'">'.trim($row->item_name).'</option></optgroup>';
    	}    	    	
    	$this->data['items'] = $output;
		
    	$departs = $this->Crud_model->get('nz_department','');
    	$output1 = '';
    	foreach($departs as $row) {
    		$output1 .= '<optgroup><option value="'.$row->id.'">'.trim($row->name).'</option></optgroup>';
    	}
    	$this->data['departs'] = $output1;

		if($this->ion_auth->in_group('user')) {	
			$this->data['sellings'] = $this->Selling_model->get('');
		}
        $this->data['csrf'] = $this->_get_csrf_nonce();

        $this->_render_page('pages/Stock/selling/' . DIRECTORY_SEPARATOR . 'add', $this->data);
    }

    public function insert() {
    
    	unset($_POST['submit']);

		// For Multiple Add Record
    	/* if(!empty($_POST["item_id"])) {
    		for($i = 0; $i < count($_POST["item_id"]); $i++)
	    	{		
	    		if(!empty($_POST["item_id"][$i])) {

		    		$additional_data = [
		    			'item_id' => $_POST["item_id"][$i],
		    			'dpt_id' => $_POST["dpt_id"][$i],
		    			'unit' => $_POST["unit"][$i],
		    			'qty' => $_POST["qty"][$i],
		    			'rate' => $_POST["rate"][$i],
		    			'total_amount' => $_POST["qty"][$i]*$_POST["rate"][$i],
		    			'outlet' => $_POST["outlet"][$i],
		    			'date' => $_POST["date"][$i],
		    			'created_at' => date('Y-m-d h:i:s'),
		    		];
	    			
	    			$done = $this->Crud_model->insert('nz_selling',$additional_data);
		    		if($done) {
		    			
						$this->Crud_model->updateById('nz_available',$_POST["item_id"][$i],[
			    			'qty' => $_POST["hidden_qty"][$i] - array_sum($_POST["qty"]),
			    			'updated_at' => date('Y-m-d h:i:s'),
			    		]);
		    		}
				}
	    	}
    	} */
		// For Single Add Record
		$additional_data = [
			'item_id' => $_POST["item_id"],
			'dpt_id' => $_POST["dpt_id"] ? $_POST["dpt_id"] : '0',
			'unit' => $_POST["unit"],
			'qty' => $_POST["qty"],
			'rate' => $_POST["rate"],
			'total_amount' => $_POST["qty"]*$_POST["rate"],
			// 'outlet' => $_POST["outlet"],
			'date' => $_POST["date"],
			'created_at' => date('Y-m-d h:i:s'),
		];
		
		$done = $this->Crud_model->insert('nz_selling',$additional_data);
		if($done) {
			
			$this->Crud_model->updateById('nz_available',$_POST["item_id"],[
				'qty' => $_POST["hidden_qty"] - $_POST["qty"],
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}
    	print_r(json_encode(['status'=>'success','msg'=>'Record Added Successfully']));
    }

    public function edit($id) {
                    
		$this->form_validation->set_rules('rate','Selling Rate','required');

		if ($this->form_validation->run() === TRUE)
		{
			 $additional_data = [
				'item_id' => $this->input->post("item_id"),
				'dpt_id' => $this->input->post("dpt_id") ? $this->input->post("dpt_id") : '0',
				'unit' => $this->input->post("unit"),
				'qty' => $this->input->post("qty"),
				'rate' => $this->input->post("rate"),
				'total_amount' => $this->input->post("qty")*$this->input->post("rate"),
				// 'outlet' => $this->input->post("outlet"),
				'date' => $this->input->post("date"),
				'updated_at' => date('Y-m-d h:i:s'),
			];

			$done = $this->Crud_model->update('nz_selling',$id,$additional_data);
			
			if($done) { 
				$getpurchase = $this->Crud_model->getByItemId('nz_purchase',$this->input->post("item_id"),'item_id');
					
				$sum_qty = 0;
				$sum_totamont = 0;
				foreach ($getpurchase as $value) {
					$sum_qty += $value->qty;
					$sum_totamont += $value->total_amount;
				}
				
				$this->Crud_model->updateById('nz_available',$this->input->post("item_id"),[
	    			'rate' => number_format(($sum_totamont / $sum_qty),2),
	    			'updated_at' => date('Y-m-d h:i:s'),
	    		]);
			}
			$this->session->set_flashdata('success', 'Record Updated Successfully');
			redirect("selling", 'refresh');
		}
		else {
			
			$this->data['title'] = "Edit Selling";

        	$this->data['selling'] = $this->Selling_model->get($id);

        	// $qtyCount = $this->Crud_model->getById('nz_available', $this->data['selling']['item_id']);
        	// $this->data['maxQty'] = $qtyCount[0]->qty ? $qtyCount[0]->qty : '';
        	// $this->data['qtyreadlonly'] = $qtyCount[0]->qty == 0 ? 'readonly' : '';
        	$this->data['departs'] = $this->Crud_model->get('nz_department','');

        	$this->data['csrf'] = $this->_get_csrf_nonce();

			$this->_render_page('pages/Stock/selling/' . DIRECTORY_SEPARATOR . 'edit', $this->data);
		}
    }

    public function delete($id, $itemId, $qty) {
		
    	$del = $this->Crud_model->delete('nz_selling',$id);		
		if($del) {
			$getQty = $this->Stock_model->get($itemId);
			
			$this->Crud_model->updateById('nz_available', $itemId,[
				'qty' => $getQty['qty'] + $qty,
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		}

    	$this->session->set_flashdata('success', 'Record Deleted Successfully');
    	redirect("selling", 'refresh');
    }

    public function getPurchaseOnChange() {
    	$id = $_POST['item_id'];
    	$data = $this->Selling_model->PurchaseOnChange($id);
    	print_r(json_encode($data[0]));
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
