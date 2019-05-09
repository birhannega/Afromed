<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reportss extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Reportss';

		$this->load->model('model_reportss');
		$this->load->model('model_brands');
		$this->load->model('model_category');
		$this->load->model('model_attributes');
	}

    /* 
    * It only redirects to the manage product page
    */
	public function index()
	{
        if(!in_array('viewitem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('reportss/index', $this->data);	
	}

    /*
    * It Fetches the products data from the product table 
    * this function is called from the datatable ajax function
    */
	public function fetchReporData()
	{
		$result = array('data' => array());

		$data = $this->model_reportss->getReporData();

		foreach ($data as $key => $value) {

            $store_data = $this->model_stores->getStoresData($value['store_id']);
			// button
            $buttons = '';
            if(in_array('viewitem', $this->permission)) {
    			$buttons .= '<a href="'.base_url('reportss/update/'.$value['id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('viewitem', $this->permission)) {
    			$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
			

			$img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $qty_status = '';
            if($value['qty'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            } else if($value['qty'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }


			$result['data'][$key] = array(
                $value['namee'],
			    $value['gebi'],
                $value['wechi'] ,
			    $value['ytemlse'],
                $value['keri'],
                $value['yetwgede'],

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

		$this->form_validation->set_rules('namee', 'property name', 'trim|required');
		$this->form_validation->set_rules('gebi', 'gebi', 'trim|required');
		$this->form_validation->set_rules('wechi', 'wechi', 'trim|required');
		$this->form_validation->set_rules('ytemlse', 'ytemlse', 'trim|required');
        $this->form_validation->set_rules('keri', 'keri', 'trim|required');
        $this->form_validation->set_rules('yetwgede', 'yetwgede', 'trim|required');
      
		
	
        if ($this->form_validation->run() == TRUE) {
            // true case
        	$upload_image = $this->upload_image();

        	$data = array(
        		'namee' => $this->input->post('namee'),
        		'gebi' => $this->input->post('gebi'),
        		'wechi' => $this->input->post('wechi'),
        		'ytemlse' => $this->input->post('ytemlse'),
        		'image' => $upload_image,
        		'description' => $this->input->post('description'),
        		'attribute_value_id' => json_encode($this->input->post('attributes_value_id')),
        		'brand_id' => json_encode($this->input->post('brands')),
        		'category_id' => json_encode($this->input->post('category')),
                'store_id' => $this->input->post('store'),
        		'availability' => $this->input->post('availability'),
                'keri' => $this->input->post('keri'),
                'yetwgede' => $this->input->post('yetwgede'),
              
        	);

        	$create = $this->model_reportss->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('reportss/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('reportss/create', 'refresh');
        	}
        }
        else {
            // false case

        	// attributes 
        	$attribute_data = $this->model_attributes->getActiveAttributeData();

        	$attributes_final_data = array();
        	foreach ($attribute_data as $k => $v) {
        		$attributes_final_data[$k]['attribute_data'] = $v;

        		$value = $this->model_attributes->getAttributeValueData($v['id']);

        		$attributes_final_data[$k]['attribute_value'] = $value;
        	}

        	$this->data['attributes'] = $attributes_final_data;
			$this->data['brands'] = $this->model_brands->getActiveBrands();        	
			$this->data['category'] = $this->model_category->getActiveCategroy();        	
			$this->data['Credits'] = $this->model_stores->getActiveStore();

            $this->render_template('reportss/create', $this->data);
        }	
	}

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = 'assets/images/repor_image';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('repor_image'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['repor_image']['name']);
            $type = $type[count($type) - 1];
            
            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
    }

    /*
    * If the validation is not valid, then it redirects to the edit product page 
    * If the validation is successfully then it updates the data into the database 
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
	public function update($repor_id)
	{      
        if(!in_array('updateitem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$repor_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('namee', 'property name', 'trim|required');
        $this->form_validation->set_rules('gebi', 'gebi', 'trim|required');
        $this->form_validation->set_rules('wechi', 'wechi', 'trim|required');
        $this->form_validation->set_rules('ytemlse', 'ytemlse', 'trim|required');
        
         $this->form_validation->set_rules('keri', 'keri', 'trim|required');
          $this->form_validation->set_rules('yetwgede', 'yetwgede', 'trim|required');
          
        if ($this->form_validation->run() == TRUE) {
            // true case
            
            $data = array(
                'namee' => $this->input->post('namee'),
                'gebi' => $this->input->post('gebi'),
                'wechi' => $this->input->post('wechi'),
                'ytemlse' => $this->input->post('ytemlse'),
                'description' => $this->input->post('description'),
                'attribute_value_id' => json_encode($this->input->post('attributes_value_id')),
                'brand_id' => json_encode($this->input->post('brands')),
                'category_id' => json_encode($this->input->post('category')),
                'store_id' => $this->input->post('store'),
                'availability' => $this->input->post('availability'),
                'keri' => $this->input->post('keri'),
                'yetwgede' => $this->input->post('yetwgede'),

                
            );

            
            if($_FILES['repor_image']['size'] > 0) {
                $upload_image = $this->upload_image();
                $upload_image = array('image' => $upload_image);
                
                $this->model_reportss->update($upload_image, $repor_id);
            }

            $update = $this->model_reportss->update($data, $repor_id);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('reportss/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('reportss/update/'.$repor_id, 'refresh');
            }
        }
        else {
            // attributes 
            $attribute_data = $this->model_attributes->getActiveAttributeData();

            $attributes_final_data = array();
            foreach ($attribute_data as $k => $v) {
                $attributes_final_data[$k]['attribute_data'] = $v;

                $value = $this->model_attributes->getAttributeValueData($v['id']);

                $attributes_final_data[$k]['attribute_value'] = $value;
            }
            
            // false case
            $this->data['attributes'] = $attributes_final_data;
            $this->data['brands'] = $this->model_brands->getActiveBrands();         
            $this->data['category'] = $this->model_category->getActiveCategroy();           
            $this->data['Credits'] = $this->model_stores->getActiveStore();

            $repor_data = $this->model_reportss->getReporData($repor_id);
            $this->data['repor_data'] = $repor_data;
            $this->render_template('reportss/edit', $this->data); 
        }   
	}

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
	public function remove()
	{
        if(!in_array('deleteRepor', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $repor_id = $this->input->post('repor_id');

        $response = array();
        if($repor_id) {
            $delete = $this->model_reportss->remove($repor_id);
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