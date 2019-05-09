<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends Admin_Controller
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
        if (!in_array('viewitem', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
        $this->data['page_title'] = 'items';
       $this->data['items'] = $this->Model_items->getItemsData();
        $this->render_template('item/index', $this->data);
    }
    
    public function checkvailablity($id=false)
    {
        $result = array();
        
        $data = $this->Model_items->getItemData($id);
        //echo json_encode($data);
        $sold=0;
        $imported=0;
        foreach ($data as $row){
            $result['name'] = $row->name;
            $result['UnitPrice'] = $row->UnitPrice;
            $result['imported'] = intval($row->instock);
            $imported=intval($row->instock);
        }
         
         // /foreach
        $salesdata = $this->Model_items->getItemSalesData($id);
        foreach ($salesdata as $row){
            $result['sold']=intval($row->sold);
            $sold=intval($row->sold);
        }
        $result['available'] =intval($imported)-intval($sold);
    
        echo json_encode($result, JSON_NUMERIC_CHECK);
    
    }
    
    /*
    * Fetches the orders data from the orders table
    * this function is called from the datatable ajax function
    */
    public function fetchItemsData()
    {
        $result = array('data' => array());
        
        $data = $this->Model_items->getItemsData();
        // echo json_encode($data);
        
        
        foreach ($data as $key => $value) {
            
            $count_total_item = $this->Model_items->countOrderItem($value['ID']);
            
            // button
            $buttons = '';
            
            if (in_array('updateitem', $this->permission)) {
                $buttons .= ' <a href="' . base_url('items/update/' . $value['ID']) . '" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }
            
            if (in_array('deleteitem', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
    
            $value['available']= intval($value['totalamount'])-intval($value['sold']);
            $result['data'][$key] = array(
                
                ucfirst($value['name']),
                ucfirst(str_replace('materials', '', $value['category'])),
                intval($value['available']),
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
        if (!in_array('createitem', $this->permission)) {
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
        $result = $this->Model_items->getItemDetails($id);
        $item_data = array();
        if (isset($result) && !empty($result)) {
            foreach ($result as $row) {
            $item_data = array(
                'itm_id' => $row['ID'],
                'itm_cat_id' => $row['itm_cat_id'],
                'itm_cat_name' => $row['cat_name'],
                'itm_name' => $row['name'],
                'itm_minimum_price' => $row['UnitPrice'],
                'item_remark' => $row['itm_remark'],
                'itm_date_created' => $row['itm_date_created'],
            );
            }
        }
        if (!in_array('updateitem', $this->permission)) {
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
            
            if (!is_array($update)) {
                $this->session->set_flashdata('success', 'Item information Successfully updated');
                redirect('items/update/' . $id);
            } else {
                if($update['code']==0){
                    $this->session->set_flashdata('error', 'You have not made any changes to the existing Item details!!');
                }else{
                    $this->session->set_flashdata('error', 'Error occurred!!');
                }
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
        if (!in_array('deleteitem', $this->permission)) {
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