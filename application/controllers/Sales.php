<?php
/**
 * Created by PhpStorm.
 * User: Pc
 * Date: 4/7/2019
 * Time: 12:21 PM
 */

class Sales extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
        $this->data['page_title'] = 'entries';
        $this->load->model('Model_entries');
        $this->load->model('Model_items');
        $this->load->model('Model_brands');
        $this->load->model('Model_category');
        $this->load->model('Model_sales');

    }

    /*
    * It only redirects to the manage product page
    */
    public function index()
    {
        if(!in_array('viewSales', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('sales/index', $this->data);
    }

    /*
    * It Fetches the products data from the product table
    * this function is called from the datatable ajax function
    */
    public function fetchSalesData($id=false)
    {
        $result = array('data' => array());

        $data = $this->Model_sales->getSalesData($id);

        foreach ($data as $key => $value) {

            // button
            $buttons = '';
            if(in_array('updateProduct', $this->permission)) {
                $buttons .= '<a href="'.base_url('sales/update/'.$value['sale_id']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['sale_id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            $result['data'][$key] = array(
                $value['Itm_name'],
                $value['sale_item_amount'],
                $value['sold_price'],
                $value['Sale_sub_total'],
                $value['Date_sold'],
                $value['soled_by'],
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
        if(!in_array('createSales', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('solditem', 'Item', 'trim|required');
        $this->form_validation->set_rules('soldprice', 'Price', 'trim|required');
        $this->form_validation->set_rules('soldquantity', 'Quantity', 'trim|required');
        $this->form_validation->set_rules('sellpayment', 'Payment Method', 'trim|required');
        $this->form_validation->set_rules('buyerinfo', 'Buyer information', 'trim|required');
        $this->form_validation->set_rules('sale_remark', 'remark', 'trim');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $saletotal= ($this->input->post('soldquantity'))*($this->input->post('soldprice'));
            $data = array(
                'sale_itm_id' => $this->input->post('solditem'),
                'sale_item_amount' => $this->input->post('soldquantity'),
                'sold_price' => $this->input->post('soldprice'),
                'sale_remark' => $this->input->post('sale_remark'),
                'soled_by' => $this->user,
                'sale_payment_option'=> $this->input->post('sellpayment'),
                'sale_buyer_info'=> $this->input->post('buyerinfo'),
                'Sale_sub_total'=>$saletotal

            );
            $create = $this->Model_sales->create($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('sales/');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('sales/create');
            }
        }
        else {
            $this->data['items'] = $this->Model_items->getItemsData();
            $this->render_template('sales/create', $this->data);
        }
    }
    public function update($imp_id)
    {
        if(!in_array('updateSales', $this->permission)) {
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
            $data = array(
                'imp_date' => $this->input->post('item_entrydate'),
                'imp_item_id' => $this->input->post('item_id'),
                'itm_item_amount' => $this->input->post('item_quantity'),
                'imp_inserted_by' => $this->input->post('item_registered_by'),
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
        if(!in_array('deleteSales', $this->permission)) {
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