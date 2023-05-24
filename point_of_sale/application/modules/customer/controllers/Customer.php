<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
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
			'customer/Customer_model' => 'cModel',
		];
		$this->load->model($model_list);
	}

	/** load main page */
	public function index()
	{
		// if (
		// 	!check_permission($this->session->Role, ['Admin'])
		// ) {
		// 	redirect(base_url() . 'login', 'refresh');
		// }

		$this->data['session'] =  $this->session;
		$this->data['customers'] = $this->cModel->get_customers();
		$this->data['content'] = 'index';
		$this->load->view('layout', $this->data);
	}

	public function get_cust_details()
	{
		$this->cModel->Cust_id = $this->input->post('Cust_id');
		echo json_encode($this->cModel->get_cust_details());
	}

	public function get_orders()
	{
		$this->cModel->Cust_id = $this->input->get('id');
		$this->data['orders'] = $this->cModel->get_orders();
		$this->data['content'] = 'grid/load_orders';
		$this->load->view('layout', $this->data);
	}

}
