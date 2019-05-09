<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Entries extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		$this->data['page_title'] = 'entries';
		$this->load->model('Model_entries');
		$this->load->model('Model_items');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('Model_sales');
        $this->data['items'] = $this->Model_items->getItemsData();
        //$this->user=$this->session->userdata('username');
    }

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewitem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('entries/index', $this->data);
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchEntryData()
	{
		$result = array('data' => array());

		$data = $this->Model_entries->getProductData();

		foreach ($data as $key => $value) {

			// button
            $buttons = '';
            if(in_array('updateitem', $this->permission)) {
    			$buttons .= '<a href="'.base_url('entries/update/'.$value['imp_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteitem', $this->permission)) {
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['imp_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			$result['data'][$key] = array(
                $value['imp_date'],
			    $value['item_name'],
                $value['imp_inserted_by'] ,
                $value['imp_item_amount'] ,
			    $value['Item_average_price'],
			    $value['imp_sub_total'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}	

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function create()
	{
		if(!in_array('createitem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('item_entrydate', 'Item entry Date', 'trim|required');
		$this->form_validation->set_rules('item_id', 'Item', 'trim|required');
		$this->form_validation->set_rules('item_quantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('item_average_price', 'Average Price', 'trim|required');
        $this->form_validation->set_rules('item_entry_remark', 'remark', 'trim');

        if ($this->form_validation->run() == TRUE) {
            // true case

        	$data = array(
        		'imp_date' => $this->input->post('item_entrydate'),
        		'imp_item_id' => $this->input->post('item_id'),
        		'imp_item_amount' => $this->input->post('item_quantity'),
        		'imp_inserted_by' => $this->user,
        		'Item_average_price' => $this->input->post('item_average_price'),
                'imp_remark' => $this->input->post('item_entry_remark'),
                'imp_sub_total' => $this->input->post('subtotal'),
        	);

        	$create = $this->Model_entries->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('entries/');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('entries/create', 'refresh');
        	}
        }
        else {

            $this->render_template('entries/create', $this->data);
        }	
	}
	public function update($imp_id)
	{      
        if(!in_array('updateitem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$imp_id) {
            redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('item_entrydate', 'Item entry Date', 'trim|required');
        $this->form_validation->set_rules('item_id', 'Item', 'trim|required');
        $this->form_validation->set_rules('item_quantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('item_registered_by', 'Registered by', 'trim|required');
        $this->form_validation->set_rules('item_average_price', 'Average Price', 'trim|required');
        $this->form_validation->set_rules('item_entry_remark', 'remark', 'trim');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $today=date('Y-m-d');
            $data = array(
                'imp_date' => $this->input->post('item_entrydate'),
                'imp_item_id' => $this->input->post('item_id'),
                'imp_item_amount' => $this->input->post('item_quantity'),
                'imp_Last_updated_by' => $this->session->userdata('username'),
                'Item_average_price' => $this->input->post('item_average_price'),
                'imp_remark' => $this->input->post('item_entry_remark'),
                'imp_sub_total' => $this->input->post('subtotal'),
            );
            $update = $this->Model_entries->update($data, $imp_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('entries/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('entries/update/'.$imp_id, 'refresh');
            }
        }
        else {
            // attributes
            $entry_data=array();
            $result = $this->Model_entries->getEntryData($imp_id);
            if(isset($result)&& !empty($result)) {
                foreach ($result as $k => $v) {
                    $entry_data = array(
                        'imp_id' => $result[$k]['imp_id'],
                        'item_id' => $result[$k]['imp_item_id'],
                        'item_name' => $result[$k]['item_name'],
                        'imp_date' => $result[$k]['imp_date'],
                        'item_amount' => $result[$k]['itm_item_amount'],
                        'average_price' => $result[$k]['Item_average_price'],
                        'insertedBy' => $result[$k]['imp_inserted_by'],
                        'subtotal' => $result[$k]['imp_sub_total'],
                        'imp_remark' => $result[$k]['imp_remark'],
                    );
                }
            }
            // false case
            $this->data['entry_data'] = $entry_data;
            $this->render_template('entries/edit', $this->data);
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteitem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $imp_id = $this->input->post('imp_id');

        $response = array();
        if($imp_id) {
            $delete = $this->Model_entries->remove($imp_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response);
	}

}