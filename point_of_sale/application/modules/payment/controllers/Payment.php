<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends MY_Controller
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
			'payment/Payment_model' => 'pModel',
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
		$this->coModel->ID = $this->input->get('custid');
		$this->pModel->OrderID = $this->input->get('oid');
		
		$this->data['cust_details'] = $this->coModel->get_customer_details();
		$this->data['items'] = $this->coModel->get_items();
		$this->data['order_items'] = $this->pModel->get_items();
		$this->data['order_dets'] = $this->pModel->get_order_details();
		$this->data['p_mode'] = $this->pModel->get_payment_modes();
		$this->data['last_paid'] = $this->pModel->get_last_paid();
		$this->data['status'] = $this->pModel->get_status();
		$this->data['p_history'] = $this->pModel->get_p_history();
		$this->data['users'] = $this->pModel->get_users();

		$this->data['sewer'] = $this->pModel->get_sewer();
		$this->data['lay_artist'] = $this->pModel->get_lay_artist();
		$this->data['set_artist'] = $this->pModel->get_set_artist();
		$this->data['o_status'] = $this->pModel->get_o_status();

		$this->data['content'] = 'index2';
		$this->load->view('layout', $this->data);
	}

	public function retrieve_design(){
		$this->pModel->OrderID = $this->input->post('Order_id');

		

	}
}
