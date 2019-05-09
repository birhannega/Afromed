<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Zekah extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'items';
        $this->load->model('Model_items');
        $this->load->model('Model_category');
    }
    /*
    * It only redirects to the manage order page
    */
    public function index()
    {
        if (!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->data['page_title'] = 'items';
        $this->render_template('item/index', $this->data);
    }
    /*
    * Fetches the orders data from the orders table
    * this function is called from the datatable ajax function
    */
    public function fetchItemsData($id=false)
    {
        $result = array('data' => array());
        
        $data = $this->Model_items->getItemsData($id);
        // echo json_encode($data);
        
        
        foreach ($data as $key => $value) {
            
            $count_total_item = $this->Model_items->countOrderItem($value['ID']);
            
            // button
            $buttons = '';
            
            if (in_array('updateOrder', $this->permission)) {
                $buttons .= ' <a href="' . base_url('items/update/' . $value['ID']) . '" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }
            
            if (in_array('deleteOrder', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            
            
            $result['data'][$key] = array(
                
                ucfirst($value['name']),
                ucfirst(str_replace('materials', '', $value['category'])),
                intval($value['available']),
                floatval( $value['average']),
                floatval($value['price']),
                $buttons
            );
        } // /foreach
        
        echo json_encode($result);
    }
    
    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database
    * and it stores the operation message into the session flashdata and display on the manage group page
    */
    public function create()
    {
        if (!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('itemname', 'Item name', 'trim|required');
        $this->form_validation->set_rules('itemcategory', 'Item Category', 'trim|required|Integer');
        $this->form_validation->set_rules('brand', 'Iterm Brand', 'trim|Integer');
        $this->form_validation->set_rules('itemremark', 'Item remark', 'trim');
        if ($this->form_validation->run() == TRUE) {
            // true case
            $user_id = $this->session->userdata('username');
            $data = array(
                'Itm_name' => $this->input->post('itemname'),
                'brand_id' => $this->input->post('brand'),
                'itm_minimum_price' => $this->input->post('itemprice'),
                'itm_cat_id' => $this->input->post('itemcategory'),
                'itm_remark' => $this->input->post('item_remark'),
                'brand_id' => 1,
                'item_created_by' => $user_id
            );
            $insert_id = $this->Model_items->create($data);
            if (!is_array($insert_id)) {
                //id should be primary key column name
                $resultObject = array(
                    "ikan.metadata" => "",
                    "value" => $data,
                    "statusCode" => 200, "type" => "save", "errorMsg" => "");
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('items/create');
            } else {
                $resultObject = array(
                    "ikan.metadata" => "",
                    "value" => $data,
                    "statusCode" => $insert_id['code'], "type" => "save",
                    "errorMsg" => $insert_id['message']
                );
                $this->session->set_flashdata('errors', json_encode($resultObject));
                redirect('items/create', 'refresh');
            }
        }
        
        $this->data['category_data'] = $this->Model_category->getActiveCategroy();
        $this->render_template('item/create', $this->data);
    }
    
    public function update($id, $result = false)
    {
        $result = $this->Model_items->getItemData($id);
        $item_data = array();
        if (isset($result) && !empty($result)) {
            $item_data = array(
                'itm_id' => $result['itm_id'],
                'itm_cat_id' => $result['itm_cat_id'],
                'itm_cat_name' => $result['cat_name'],
                'itm_name' => $result['Itm_name'],
                'itm_minimum_price' => $result['itm_minimum_price'],
                'item_remark' => $result['itm_remark'],
                'itm_date_created' => $result['itm_date_created'],
            );
        }
        if (!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        if (!$id) {
            redirect('dashboard', 'refresh');
        }
        
        $this->form_validation->set_rules('itemname', 'Item name', 'trim|required');
        $this->form_validation->set_rules('itemcategory', 'Item Category', 'trim|required|Integer');
        $this->form_validation->set_rules('price', 'Price', 'trim|Integer');
        $this->form_validation->set_rules('itemremark', 'Item remark', 'trim');
        
        if ($this->form_validation->run() == TRUE) {
            $user_id = $this->session->userdata('id');
            $data = array(
                'Itm_name' => $this->input->post('itemname'),
                'brand_id' => $this->input->post('brand'),
                'itm_cat_id' => $this->input->post('itemcategory'),
                'itm_minimum_price' => $this->input->post('price'),
                'itm_remark' => $this->input->post('item_remark'),
                'brand_id' => 1,
                'item_created_by' => $user_id
            );
            $update = $this->Model_items->update($id, $data);
            
            if ($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('items/update/' . $id);
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('items/update/' . $id);
            }
        }
        $this->data['category_data'] = $this->Model_category->getActiveCategroy();
        $this->data['item_data'] = $item_data;
        $this->render_template('item/edit', $this->data);
        
        
    }
    
    
    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
    public function remove()
    {
        if (!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $order_id = $this->input->post('order_id');
        $response = array();
        if ($order_id) {
            $delete = $this->model_orders->remove($order_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }
        
        echo json_encode($response);
    }
    
}