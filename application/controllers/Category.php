<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->not_logged_in();
        
        $this->data['page_title'] = 'Category';
        
        $this->load->model('Model_category');
    }
    
    /*
    * It only redirects to the manage category page
    */
    public function index()
    {
        
        if (!in_array('viewCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $this->render_template('categories/index', $this->data);
    }
    
    /*
    * It checks if it gets the category id and retreives
    * the category information from the category model and
    * returns the data into json format.
    * This function is invoked from the view page.
    */
    public function fetchCategoryDataById($id)
    {
        if ($id) {
            $data = $this->Model_category->getCategoryData($id);
            echo json_encode($data);
        }
        
        return false;
    }
    
    /*
    * Fetches the category value from the category table
    * this function is called from the datatable ajax function
    */
    public function fetchCategoryData()
    {
        $result = array('data' => array());
        
        $data = $this->Model_category->getCategoryData();
        
        foreach ($data as $key => $value) {
            
            // button
            $buttons = '';
            
            if (in_array('updateCategory', $this->permission)) {
                $buttons .= '<a href="'.base_url().'category/update/'.$value['cat_id'].'"><button type="button" class="btn btn-default"  data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button></a>';
            }
            
            if (in_array('deleteCategory', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['cat_id'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            
            $result['data'][$key] = array(
                $value['cat_name'],
                $value['cat_desc'],
                $value['cat_created_by'],
                $value['cat_remark'],
                $buttons
            );
        } // /foreach
        
        echo json_encode($result);
    }
    
    /*
    * Its checks the category form validation
    * and if the validation is successfully then it inserts the data into the database
    * and returns the json format operation messages
    */
    public function create()
    {
        if (!in_array('createCatagory', $this->permission)) {
            redirect('dashboard');
            
        }
        $response = array();
        $response['page_title'] = 'Create Category';
        $this->form_validation->set_rules('cat_name', 'Category name', 'trim|required');
        $this->form_validation->set_rules('cat_desc', 'Description', 'trim|required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'cat_name' => $this->input->post('cat_name'),
                'cat_desc' => $this->input->post('cat_desc'),
                'cat_remark' => $this->input->post('cat_remark')
            );
            
            $create = $this->Model_category->create($data);
            if ($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
            } else {
                $this->session->set_flashdata('error', 'Error in the database while creating the category information');
            }
        }
        $this->render_template('Categories/create', $this->data);
    
    }
    
    /*
    * Its checks the category form validation
    * and if the validation is successfully then it updates the data into the database
    * and returns the json format operation messages
    */
    public function update($id)
    {
        
        if (!in_array('updateCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $entry_data=array();
        $response = array();
        
            $this->form_validation->set_rules('cat_name', 'Category name', 'trim|required');
            $this->form_validation->set_rules('cat_desc', 'Category Description', 'trim|required');
            
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'cat_name' => $this->input->post('cat_name'),
                    'cat_desc' => $this->input->post('cat_desc'),
                );
                
                $update = $this->Model_category->update($data, $id);
                if ($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Succesfully updated';
                    $this->session->set_flashdata('success', $response['messages']);
                } else {
                    $response['success'] = false;
                    $response['messages'] = 'Error in the database while updated the brand information';
                }
            }
            else{
                if ($id) {
                $result = $this->Model_category->getCategoryData($id);
                //echo json_encode($result);
               
            }
          
        }
        $this->data['entry_data'] =$this->Model_category->getCategoryData($id);
        $this->render_template('categories/edit', $this->data);
    }
    /*
    * It removes the category information from the database
    * and returns the json format operation messages
    */
    public function remove()
    {
        if (!in_array('deleteCategory', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $category_id = $this->input->post('cat_id');
        
        $response = array();
        if ($category_id) {
            $delete = $this->Model_category->remove($category_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            } else {
                $response['success'] =json_encode($delete);
                echo $response;
                $response['messages'] = "Error in the database while removing the brand information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }
        
        echo json_encode($response);
    }
    
}