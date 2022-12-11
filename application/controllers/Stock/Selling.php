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
		$this->load->model('ion_auth_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in())
		{
			redirect('login', 'refresh');
		}		

		$this->data['pagename'] = 'pursell';
	}

	public function add() {

        $this->data['title'] = "Add Selling";

		$vendors = $this->Crud_model->get('nz_vendors','');
    	$output = '';
    	foreach($vendors as $row) {
    		 $output .= '<optgroup><option value="'.$row->id.'">'.trim($row->name).'</option></optgroup>';
    	}
    	$this->data['vendors'] = $output;

		$items = $this->Crud_model->get('nz_items','');
    	$output = '';
    	foreach($items as $row) {
    		$output .= '<optgroup><option value="'.$row->id.'">'.trim($row->name).'</option></optgroup>';
    	}    	    	
    	$this->data['items'] = $output;
		
        $this->data['csrf'] = $this->_get_csrf_nonce();

        $this->_render_page('pages/Stock/selling/' . DIRECTORY_SEPARATOR . 'add', $this->data);
    }

    public function insert() {
    
    	unset($_POST['submit']);

    	if(!empty($_POST["item_id"])) {
    		for($i = 0; $i < count($_POST["item_id"]); $i++)
	    	{		
	    		if(!empty($_POST["item_id"][$i])) {

		    		$additional_data = [
		    			'po_no' => $_POST["po_no"][$i],
		    			'vendor_id' => $_POST["vendor_id"][$i],
		    			'item_id' => $_POST["item_id"][$i],
		    			'sub_item_id' => isset($_POST["sub_item_id"][$i]) ? $_POST["sub_item_id"][$i] : '0',
		    			'qty' => $_POST["qty"][$i],
		    			'rate' => $_POST["rate"][$i],
		    			'total_amount' => $_POST["qty"][$i]*$_POST["rate"][$i],
		    			'date' => $_POST["date"][$i],
		    			'created_at' => date('Y-m-d h:i:s'),
		    		];
	    			
	    			$done = $this->Crud_model->insert('nz_selling',$additional_data);
		    		/* if($done) {
		    			
						$getavail = $this->Crud_model->getStockAvail($_POST["item_id"][$i],$_POST["sub_item_id"][$i]);

						$this->Crud_model->updateStockByIds($_POST["item_id"][$i],$_POST["sub_item_id"][$i],[
			    			'sqty' => $getavail[0]->sqty + $_POST["qty"][$i],
			    			'qty' => $_POST["hidden_qty"][$i] - $_POST["qty"][$i],
			    			'updated_at' => date('Y-m-d h:i:s'),
			    		]);
		    		} */
				}
	    	}
    	}
		
    	print_r(json_encode(['status'=>'success','msg'=>'Record Added Successfully']));
    }

    public function edit($id) {
                    
		$this->form_validation->set_rules('rate','Selling Rate','required');

		if ($this->form_validation->run() === TRUE)
		{
			 $additional_data = [
				'po_no' => $this->input->post("po_no"),
				'vendor_id' => $this->input->post("vendor_id"),
				'item_id' => $_POST["item_id"],
		    	'sub_item_id' => isset($_POST["sub_item_id"]) ? $_POST["sub_item_id"] : '0',
				'qty' => $this->input->post("qty"),
				'rate' => $this->input->post("rate"),
				'total_amount' => $this->input->post("qty")*$this->input->post("rate"),
				'date' => $this->input->post("date"),
				'updated_at' => date('Y-m-d h:i:s'),
			];

			$done = $this->Crud_model->update('nz_selling',$id,$additional_data);
			
			/* if($done) { 
				
				$this->Crud_model->updateStockByIds($_POST["item_id"],$_POST["sub_item_id"],[
					'sqty' => $_POST["qty"],
					'qty' => $_POST['tot_qty'] - $_POST["qty"],
					'updated_at' => date('Y-m-d h:i:s'),
				]);
			} */
			$this->session->set_flashdata('success', 'Record Updated Successfully');
			redirect("stocks", 'refresh');
		}
		else {
			
			$this->data['title'] = "Edit Selling";

			/* $ids = $this->Crud_model->get('nz_selling',$id);
			$query = $this->db->query('SELECT * FROM `sms_available` WHERE item_id='.$ids['item_id'].' && sub_item_id='.$ids['sub_item_id']);
			$qtyCount = $query->row_array();
			$this->data['totqty'] = $qtyCount['pqty']; */

			$this->data['items'] = $this->Crud_model->get('nz_items','');	
        	$this->data['selling'] = $this->Crud_model->get('nz_selling',$id);
			$this->data['vendors'] = $this->Crud_model->get('nz_vendors','');	
        	$this->data['departs'] = $this->Crud_model->get('nz_department','');

        	$this->data['csrf'] = $this->_get_csrf_nonce();

			$this->_render_page('pages/Stock/selling/' . DIRECTORY_SEPARATOR . 'edit', $this->data);
		}
    }

    public function delete($id, $itemId, $subid, $qty) {
		
    	$del = $this->Crud_model->delete('nz_selling',$id);
		/* if($del) {
			$getQty = $this->Crud_model->getStockAvail($itemId,$subid);
			
			$this->Crud_model->updateStockByIds($itemId, $subid,[
				'sqty' => $getQty[0]->sqty - $qty,
				'qty' => $getQty[0]->qty + $qty,
				'updated_at' => date('Y-m-d h:i:s'),
			]);
		} */

    	$this->session->set_flashdata('success', 'Record Deleted Successfully');
    	redirect("stocks", 'refresh');
    }

    public function getPurchaseItemsOnChange() {
		
		$queryp = $this->db->query('SELECT * FROM `nz_purchase` WHERE item_id='.$_POST['item_id'].' && sub_item_id='.$_POST['sub_item_id'])->result();
		$pqty = 0;
		foreach ($queryp as $val) {
			$pqty += $val->qty;
		}
		$querys = $this->db->query('SELECT * FROM `nz_selling` WHERE item_id='.$_POST['item_id'].' && sub_item_id='.$_POST['sub_item_id'])->result();
		$sqty = 0;
		foreach ($querys as $val) {
			$sqty += $val->qty;
		}
		$data = $pqty-$sqty;
    	// $data = $this->Crud_model->getStockAvail($id,$sid);
    	print_r(($data));
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
