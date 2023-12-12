<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Create_order extends MY_Controller
{
	private $data = [];
	protected $session;
	public function __construct()
	{
		parent::__construct();
		$this->session = (object)get_userdata(USER);

		if(is_empty_object($this->session)){
			redirect(base_url().'login/authentication', 'refresh');
		}

		$model_list = [
			'create_order/Create_order_model' => 'coModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		// if (
		// 	!check_permission($this->session->User_type, ['admin'])
		// ) {
		// 	redirect(base_url() . 'landing_page', 'refresh');
		// }

		$this->data['session'] =  $this->session;
		$ID = $this->uri->segment(3);
		$this->coModel->ID = $ID;
		$this->data['cust_details'] = $this->coModel->get_customer_details();
		$this->data['items'] = $this->coModel->get_items();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function add_order()
	{
		// if (
		// 	!check_permission($this->session->User_type, ['admin'])
		// ) {
		// 	redirect(base_url() . 'landing_page', 'refresh');
		// }

		$this->data['session'] =  $this->session;
		$this->coModel->ID = $this->input->get("custid");
		$this->coModel->order_id = $this->input->get("oid");
		$this->data['custID'] = $this->input->get("custid");
		$this->data['OID'] = $this->input->get("oid");
		$this->data['cust_details'] = $this->coModel->get_customer_details();
		$this->data['items'] = $this->coModel->get_items();
		$this->data['content'] = 'edit_order';
		$this->load->view('layout', $this->data);

	}

	public function retrieve_order()
	{
		$this->coModel->ID = $this->input->post("ID");
		$response = $this->coModel->retrieve_order();
		echo json_encode($response);
	}


}
