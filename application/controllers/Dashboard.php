<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Dashboard';
		
		$this->load->model('Model_entries');
		$this->load->model('Model_category');
		$this->load->model('Model_items');
		$this->load->model('model_users');
		$this->load->model('Model_sales');
	}
	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{
	$this->data['total_items'] = $this->Model_items->CountItems();
	$this->data['total_categories'] = $this->Model_category->countcategories();
//		$this->data['total_paid_orders'] = $this->model_orders->countTotalPaidOrders();
//		$this->data['total_users'] = $this->model_users->countTotalUsers();
	$this->data['today_sales'] = $this->Model_sales->Count_today_Sales();
		

		$user_id = $this->session->userdata('id');
		$is_admin = ($user_id == 1) ? true :false;

		$this->data['is_admin'] = $is_admin;
		$this->render_template('dashboard', $this->data);
	}
}